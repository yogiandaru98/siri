<?php
// session_start();
?>
<form method="post" action="sLogin.php">
        <div class="txt_field">
          <input type="text" name="username" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password" required>
          <span></span>
          <label>Password</label>
             
        </div>
        <div class="txt_field">
            
            <select name="role_id" id="role_id" class="form-select" aria-label="Default select example">
                <?php
    
                include("../db/func.php");
                $pdo = pdo_connect_mysql();
                // $msg = '';
                $sql = "SELECT * FROM roles ORDER BY id_role ASC";
                $data = $pdo->query($sql);
                foreach ($data as $row) {
                    echo "<option value=$row[id_role]>$row[role_name]</option>";
                }
                ?>

                </select>
        </div>
        <input type="submit" value="Login">
      </form>