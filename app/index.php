<?php
session_start();
$error = false;
if (isset($_SESSION['id_user'])) {
  header("location: index.php");
} else {
  $submit = @$_POST['submit'];
  $username = @$_POST['username'];
  $password = @$_POST['password'];
  $encodedPassword = md5($password);
  if (isset($submit)) {
    if($username == '' || $password == '') {
      $error = true;
    } else {
      include_once('./config/db.php');
      $query = "SELECT users.id, roles.nama_role FROM users ";
      $query .= "LEFT JOIN roles ON roles.id = users.id_role ";
      $query .= "WHERE username='$username' AND password='$encodedPassword'";
      $result = $connect->query($query);
      if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $id_user = $user['id'];
        $role = $user['nama_role'];
        $query = "SELECT nama_lengkap, status FROM biodata WHERE id_user = '$id_user'";
        $result = $connect->query($query);
        if ($result->num_rows > 0) {
          $biodata = $result->fetch_assoc();
          if ($biodata['status']) {
            $_SESSION['id_user'] = $id_user;
            $_SESSION['nama_lengkap'] = $biodata['nama_lengkap'];
            $_SESSION['role'] = $role;
            if ($role === 'mahasiswa') {
              $query = "SELECT prodi.nama_prodi FROM mahasiswa ";
              $query .= "LEFT JOIN prodi ON prodi.id = mahasiswa.id_prodi ";
              $query .= "WHERE id_user = '$id_user'";
              $result = $connect->query($query);
              if ($result->num_rows > 0) {
                $prodi = $result->fetch_assoc();
                $_SESSION['nama_prodi'] = $prodi['nama_prodi'];
              }
            }
            header("location: index.php");
          } else {
            $error = true;
            $errorText = "Akun ini tidak aktif, silahkan hubungi administrator";
          }
        }
      } else {
        $error = true;
        $errorText = "NIM atau password salah";
      }
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
   

    <style>
    @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

text {
  text-align: center;
}


html,
body {
  display: grid;
  height: 100%;
  width: 100%;
  place-items: center;
  background-image: linear-gradient(62deg, #8ec5fc 0%, #e0c3fc 100%);
}

::selection {
  background: #1a75ff;
  color: #fff;
}

.wrapper {
  overflow: hidden;
  max-width: 390px;
  background: #fff;
  padding: 30px;
  border-radius: 15px;
  box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;
}

.wrapper .title-text {
  display: flex;
  width: 300%;
}

.wrapper .title {
  width: 33.33%;
  font-size: 35px;
  font-weight: 600;
  text-align: center;
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.wrapper .slide-controls {
  position: relative;
  display: flex;
  height: 50px;
  width: 100%;
  overflow: hidden;
  margin: 30px 0 10px 0;
  justify-content: space-between;
  border: 1px solid lightgrey;
  border-radius: 15px;
}

.slide-controls .slide {
  height: 100%;
  width: 33.33%;
  color: #fff;
  font-size: 18px;
  font-weight: 500;
  text-align: center;
  line-height: 48px;
  cursor: pointer;
  z-index: 1;
  transition: all 0.6s ease;
}

.slide-controls label.operator,
.slide-controls label.professor {
  color: #000;
}

.slide-controls .slider-tab {
  position: absolute;
  height: 100%;
  width: 33.33%;
  left: 0;
  z-index: 0;
  border-radius: 15px;
  background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6);
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

input[type="radio"] {
  display: none;
}

#student:checked ~ .slider-tab {
  left: 0;
}

#operator:checked ~ .slider-tab {
  left: 33.33%;
}

#professor:checked ~ .slider-tab {
  left: 66.66%;
}

#student:checked ~ label.student {
  color: #fff;
  cursor: default;
  user-select: none;
}

#operator:checked ~ label.operator,
#professor:checked ~ label.professor {
  color: #fff;
  cursor: default;
  user-select: none;
}

#student:checked ~ label.operator,
#student:checked ~ label.professor {
  color: #000;
}

#operator:checked ~ label.student,
#professor:checked ~ label.student {
  color: #000;
}

.wrapper .form-container {
  width: 100%;
  overflow: hidden;
}

.form-container .form-inner {
  display: flex;
  width: 300%;
}

.form-container .form-inner form {
  width: 33.33%;
  transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.form-inner form .field {
  height: 50px;
  width: 100%;
  margin-top: 20px;
}

.form-inner form .field input {
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 15px;
  border-radius: 15px;
  border: 1px solid lightgrey;
  border-bottom-width: 2px;
  font-size: 17px;
  transition: all 0.3s ease;
}

.form-inner form .field input:focus {
  border-color: #1a75ff;
}

.form-inner form .field input::placeholder {
  color: #999;
  transition: all 0.3s ease;
}

form .field input:focus::placeholder {
  color: #1a75ff;
}

.form-inner form .pass-link {
  margin-top: 5px;
}

.form-inner form .signup-link {
  text-align: center;
  margin-top: 30px;
}

.form-inner form .pass-link a,
.form-inner form .signup-link a {
  color: #1a75ff;
  text-decoration: none;
}

.form-inner form .pass-link a:hover,
.form-inner form .signup-link a:hover {
  text-decoration: underline;
}

form .btn {
  height: 50px;
  width: 100%;
  border-radius: 15px;
  position: relative;
  overflow: hidden;
}

form .btn .btn-layer {
  height: 100%;
  width: 300%;
  position: absolute;
  left: -100%;
  background: -webkit-linear-gradient(
    right,
    #003366,
    #004080,
    #0059b3,
    #0073e6
  );
  border-radius: 15px;
  transition: all 0.4s ease;
}

form .btn:hover .btn-layer {
  left: 0;
}

form .btn input[type="submit"] {
  height: 100%;
  width: 100%;
  z-index: 1;
  position: relative;
  background: none;
  border: none;
  color: #fff;
  padding-left: 0;
  border-radius: 15px;
  font-size: 20px;
  font-weight: 500;
  cursor: pointer;
}
    </style>

 
  <title>Siakad Portal</title>
  <link rel="stylesheet" href="./style.css">
</head>
<h1>Selamat Datang Di Portal Siakad</h1>
<body>
  <div class="wrapper">
    <div class="title-text">
      <div class="title student">Login Mahasiswa</div>
      <div class="title operator">Login Operator</div>
      <div class="title professor">Login Dosen</div>
    </div>
    <div class="form-container">
      <div class="slide-controls">
        <input type="radio" name="slide" id="student" checked />
        <input type="radio" name="slide" id="operator" />
        <input type="radio" name="slide" id="professor" />
        <label for="student" class="slide student">Mahasiswa</label>
        <label for="operator" class="slide operator">Operator</label>
        <label for="professor" class="slide professor">Dosen</label>
        <div class="slider-tab"></div>
      </div>
      <?php
              if ($error) {
            ?>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
              <i class="fas fa-exclamation-triangle bi flex-shrink-0 me-2" width="24" height="24"></i>
              <div><strong>Gagal!</strong> <?= $errorText ?></div>
            </div>
            <?php 
              }
            ?>
   
   <div class="form-inner">
    <!-- Formulir Login Mahasiswa -->
    <form method="POST" class="login student">
        <div class="field">
            <input type="text" id="emailStudent" name="username" placeholder="Masukkan NIM" required>
        </div>
        <div class="field">
            <input type="password" name="password" placeholder="Masukkan Password" required>
        </div>
        <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login Mahasiswa" name="submit">
        </div>
    </form>

    <!-- Formulir Login Operator -->
    <form method="POST" class="login operator">
        <div class="field">
            <input type="text" id="emailOperator" name="username" placeholder="Masukkan Username" required>
        </div>
        <div class="field">
            <input type="password" name="password" placeholder="Masukkan Password" required>
        </div>
        <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login Operator" name="submit">
        </div>
    </form>

    <!-- Formulir Login Dosen -->
    <form method="POST"  class="login professor">
        <div class="field">
            <input type="text" id="emailProfessor" name="username" placeholder="Masukkan NIP" required>
        </div>
        <div class="field"> 
            <input type="password" name="password" placeholder="Masukkan Password" required>
        </div>
        <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login Dosen" name="submit">
        </div>
    </form>
</div>

   
      </div>
    </div>
  </div>
  <script>
  document.addEventListener("DOMContentLoaded", function () {
  const loginText = document.querySelector(".title-text");
  const loginForm = document.querySelector("form.login");
  const loginBtn = document.querySelector("label.login");
  const studentLabel = document.querySelector(".slide.student");
  const operatorLabel = document.querySelector(".slide.operator");
  const professorLabel = document.querySelector(".slide.professor");

  studentLabel.addEventListener("click", function () {
    updateFormVisibility("student");
  });

  operatorLabel.addEventListener("click", function () {
    updateFormVisibility("operator");
  });

  professorLabel.addEventListener("click", function () {
    updateFormVisibility("professor");
  });

  function updateFormVisibility(formType) {
    if (formType === "student") {
      loginForm.style.marginLeft = "0%";
      loginText.style.marginLeft = "0%";
    } else if (formType === "operator") {
      loginForm.style.marginLeft = "-33.33%";
      loginText.style.marginLeft = "-105%";
    } else if (formType === "professor") {
      loginForm.style.marginLeft = "-66.66%";
      loginText.style.marginLeft = "-200.66%";
    }
  }
});

</script>
</body>
</html>