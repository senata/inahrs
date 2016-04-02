<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Indonesian Hearts Rhythm Sociaty</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/assets/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/assets/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <nav class="white" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="#" class="brand-logo"><img src="/assets/images/logo.png" /></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="container">
    <div class="section">
    <form class="" method="post" action="http://www.inahrs.or.id/crashprogram/submit" id="crashreg">

                    <fieldset>
                        <legend>
                            <!-- Contact Information -->
                        </legend>
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="mdi-action-account-circle prefix"></i>
                                <input name="fullname" id="icon_prefix" class="validate" length="50" required="" type="text">
                                <label for="icon_prefix">
                                    Full Name
                                </label>
                            <span style="float: right; font-size: 12px; height: 1px;" class="character-counter"></span></div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="mdi-content-mail prefix"></i>
                                <input name="email" id="email" class="validate" required="" type="email">
                                <label for="icon_telephone">
                                    Email
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="mdi-communication-phone prefix"></i>
                                <input name="phone" id="phone" class="validate" required="" type="tel">
                                <label for="icon_telephone">
                                    Telephone
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="mdi-communication-stay-current-portrait prefix"></i>
                                <input name="mobile" id="mobile" class="validate" required="" type="tel">
                                <label for="icon_telephone">
                                    Mobile
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="mdi-social-location-city prefix"></i>
                                <input name="almamater" id="almamater" class="validate" required="" type="tel">
                                <label for="icon_telephone">
                                    Alma-mater
                                </label>
                            </div>
                        </div>

                    </fieldset>

                    <div class="divider"></div><br>

                    <fieldset>
                        <legend>
                            <i class="mdi-maps-local-hospital left"></i> Please Let Us Know A Bit About The Hospital You Work At
                        </legend>


                        <div class="row">
                            <div class="input-field col s12">
                                <input name="hospital_name" id="hospital_name" class="validate" required="" type="tel">
                                <label for="icon_telephone">
                                    Hospital Name
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input name="hospital_address" id="hospital_address" class="validate" required="" type="tel">
                                <label for="icon_telephone">
                                    Hospital Address
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <select name="hospital_province" class="browser-default" required="">
                                    <option value="" selected="">
                                        Choose Hospital Province
                                    </option>

                                                                            <option value="Bali">Bali</option>
                                                                            <option value="Banten">Banten</option>
                                                                            <option value="Bengkulu">Bengkulu</option>
                                                                            <option value="DI Yogyakarta">DI Yogyakarta</option>
                                                                            <option value="DKI Jakarta">DKI Jakarta</option>
                                                                            <option value="Gorontalo">Gorontalo</option>
                                                                            <option value="Jambi">Jambi</option>
                                                                            <option value="Jawa Barat">Jawa Barat</option>
                                                                            <option value="Jawa Tengah">Jawa Tengah</option>
                                                                            <option value="Jawa Timur">Jawa Timur</option>
                                                                            <option value="Kalimantan Barat">Kalimantan Barat</option>
                                                                            <option value="Kalimantan Selatan">Kalimantan Selatan</option>
                                                                            <option value="Kalimantan Tengah">Kalimantan Tengah</option>
                                                                            <option value="Kalimantan Timur">Kalimantan Timur</option>
                                                                            <option value="Kalimantan Utara">Kalimantan Utara</option>
                                                                            <option value="Kepulauan Bangka Belitung">Kepulauan Bangka Belitung</option>
                                                                            <option value="Kepulauan Riau">Kepulauan Riau</option>
                                                                            <option value="Lampung">Lampung</option>
                                                                            <option value="Maluku">Maluku</option>
                                                                            <option value="Maluku Utara">Maluku Utara</option>
                                                                            <option value="Nanggroe Aceh Darussalam">Nanggroe Aceh Darussalam</option>
                                                                            <option value="Nusa Tenggara Barat">Nusa Tenggara Barat</option>
                                                                            <option value="Nusa Tenggara Timur">Nusa Tenggara Timur</option>
                                                                            <option value="Papua">Papua</option>
                                                                            <option value="Papua Barat">Papua Barat</option>
                                                                            <option value="Riau">Riau</option>
                                                                            <option value="Sulawesi Barat">Sulawesi Barat</option>
                                                                            <option value="Sulawesi Selatan">Sulawesi Selatan</option>
                                                                            <option value="Sulawesi Tengah">Sulawesi Tengah</option>
                                                                            <option value="Sulawesi Tenggara">Sulawesi Tenggara</option>
                                                                            <option value="Sulawesi Utara">Sulawesi Utara</option>
                                                                            <option value="Sumatera Barat">Sumatera Barat</option>
                                                                            <option value="Sumatera Selatan">Sumatera Selatan</option>
                                                                            <option value="Sumatera Utara">Sumatera Utara</option>
                                    
                                </select>
                                <label for="icon_telephone">
                                    <!-- Hospital Province -->
                                </label>

                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <input id="hospital_city" class="validate" name="hospital_city" required="" type="tel">
                                <label for="icon_telephone">
                                    <!-- Hospital City -->
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <span>Hospital Has Cath Lab / C-Arm ?</span><br>
                                <select name="hospital_carm_available" class="browser-default" required="">
                                    <option value=""></option>
                                    <option value="0" selected="">
                                        No
                                    </option>
                                    <option value="1">
                                        Yes
                                    </option>

                                </select>
                                <label for="icon_telephone">
                                    <!-- Hospital Has Cath Lab / C-Arm ? -->
                                </label>
                            </div>
                        </div>


                        <button id="submit" class="btn waves-effect waves-light" type="submit" name="action">Register
                            <i class="mdi-hardware-keyboard-arrow-right right"></i>
                        </button>

                    </fieldset>

                </form>
                </div>
                </div>
                <div class="footer-copyright">
      <div class="container">
      Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/assets/js/materialize.js"></script>
  <script src="/assets/js/init.js"></script>

  </body>
</html>