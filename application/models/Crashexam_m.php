<?php
/**
 * Created by PhpStorm.
 * User: doniking
 * Date: 28-Mar-15
 * Time: 2:33 PM
 */


class Crashexam_m extends CI_Model
{


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function getTest($test_id)
    {
        $query = $this->db->get_where('crashexam_test', array( 'id' => $test_id ));
        $test = $query->row_array();

        // get questions
        $query = $this->db->get_where('crashexam_question', array( 'test_id' => $test_id) );
        $questions = $query->result_array();

        $test['questions'] = $questions;

        return $test;
    }

    function getAllTests(){
        $sql = "SELECT t.*, count(q.id) AS question_total
                FROM crashexam_test t
                INNER JOIN crashexam_question q ON q.test_id=t.id
                GROUP BY t.id;";
        $query = $this->db->query($sql);
        $tests = $query->result_array();

        return $tests;
    }
    function getTests($member_id)
    {
        $sql = "SELECT t.*, count(q.id) AS question_total
                FROM crashexam_test t
                INNER JOIN crashexam_question q ON q.test_id=t.id
                INNER JOIN crashexam_test_member tm ON tm.test_id=t.id AND tm.member_id=$member_id
                GROUP BY t.id;";
        $query = $this->db->query($sql);
        $tests = $query->result_array();

        return $tests;
    }

    function answer($test_id, $question_id, $member_id, $answer)
    {
        // get question type
        $query = $this->db->get_where('crashexam_question', array('id'=>$question_id, 'test_id'=>$test_id));
        $question = $query->row_array();

        // insert jawaban
        $data = array(
            'member_id' => $member_id,
            'test_id' => $test_id,
            'question_id' => $question_id,
            'status' => 'answered'
        );

        if($question['type'] == 'mp') {
            $data['answer_radio'] = $answer;
        } else if ($question['type'] == 'essay') {
            if(trim($answer) == '') return;
            $data['answer_textarea'] = $answer;
        } else if (is_numeric($question['type'])) {
            $data['answer_input'] = @serialize($answer);
        }

        // check if answer exist

        $this->db->where('member_id',$member_id);
        $this->db->where('test_id',$test_id);
        $this->db->where('question_id',$question_id);
        $query = $this->db->get('crashexam_member_answer');
        if ( $query->num_rows() > 0 )
        {
            $this->db->where('member_id',$member_id);
            $this->db->where('test_id',$test_id);
            $this->db->where('question_id',$question_id);
            $this->db->update('crashexam_member_answer', $data);
        } else {
            $this->db->insert('crashexam_member_answer', $data);
        }


    }

    public function startTest($test_id, $member_id)
    {
        $data = array(
            'test_id' => $test_id,
            'member_id' => $member_id,
            'starttime' => date('Y-m-d H:i:s')
        );

        $this->db->where('member_id',$member_id);
        $this->db->where('test_id',$test_id);
        $query = $this->db->get('crashexam_member_test');
        if ( $query->num_rows() == 0 )
        {
            $this->db->insert('crashexam_member_test', $data);

            $this->db->where('member_id',$member_id);
            $this->db->where('test_id',$test_id);
            $query = $this->db->get('crashexam_member_test');
            return $query->row_array();

        } else {
            return $query->row_array();
        }

    }

    function getMemberlist($test_id)
    {
        $sql = "SELECT m.*, COUNT(ma.member_id) AS answered, (SELECT question_total from crashexam_test where id=$test_id) AS question_total
                FROM crashprogram_member m
                INNER JOIN crashexam_test_member tm ON m.id=tm.member_id
                LEFT JOIN crashexam_member_answer ma ON m.id=ma.member_id
                where tm.test_id=$test_id
                GROUP BY m.id";
        $query = $this->db->query($sql);
        return $query->result_array($query);
    }

    function getMemberAnswers($test_id, $member_id)
    {
        // first get all questions
        $this->db->select('id, question, type, optiona, optionb, optionc, optiond, optione, correctanswer');
        $this->db->order_by('id asc', 'test_id asc');
        $q = $this->db->get_where('crashexam_question', array('test_id'=>$test_id));
        $questions = $q->result_array();

        // get member answers
        $this->db->select('question_id, status, answer_radio, answer_textarea, answer_input');
        $q = $this->db->get_where('crashexam_member_answer' , array( 'test_id'=>$test_id, 'member_id'=>$member_id ));
        $answers = $q->result_array();

        $result = array();

        // merge questions and answers
        // $data[0][question] = '';
        // $data[0][answer] = '';
        foreach($answers as $answer){ // atur answers
            $data_answers[$answer['question_id']] = $answer;
        }
        $qnum = 1;
        foreach($questions as $key=>$question){
            $question['number'] = $qnum;
            $questions[$key]['question'] = $question;

            // format answer
            if($question['type'] == 'mp') {
                $questions[$key]['question']['question'] .= '<br />';
                if(@$questions[$key]['question']['optiona']) $questions[$key]['question']['question'] .= 'a. ' . $questions[$key]['question']['optiona'] . '<br />';
                if(@$questions[$key]['question']['optionb']) $questions[$key]['question']['question'] .= 'b. ' .$questions[$key]['question']['optionb'] . '<br />';
                if(@$questions[$key]['question']['optionc']) $questions[$key]['question']['question'] .= 'c. ' .$questions[$key]['question']['optionc'] . '<br />';
                if(@$questions[$key]['question']['optiond']) $questions[$key]['question']['question'] .= 'd. ' .$questions[$key]['question']['optiond'] . '<br />';
                if(@$questions[$key]['question']['optione']) $questions[$key]['question']['question'] .= 'e. ' .$questions[$key]['question']['optione'] . '<br />';
                $ans = @$data_answers[$question['id']]['answer_radio'];
            } else if ($question['type'] == 'essay') {
                $ans = @$data_answers[$question['id']]['answer_textarea'];
            } else if(is_numeric($question['type'])) {
                $inputs = @unserialize($data_answers[$question['id']]['answer_input']);
                $i=1;
                $ans = '';
                if($inputs) {
                    foreach($inputs as $input){
                        $ans .= $i . '. ' . $input . '<br />';

                        $i++;
                    }
                }
            } else {

            }

            $questions[$key]['answer'] = (isset($data_answers[$question['id']])) ? $ans : null;

            $qnum++;
        }

        return $questions;


    }

    public function getCurrentMemberAnswers($member_id, $test_id)
    {
        $this->db->select('ma.*, q.type');
        $this->db->join('crashexam_question q', 'q.id=ma.question_id', 'left');
        $query = $this->db->get_where('crashexam_member_answer ma', array( 'ma.member_id'=>$member_id, 'ma.test_id'=>$test_id ) );
        return $query->result_array();
    }

}