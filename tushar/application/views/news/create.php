<!-- <h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('news/create'); ?>

    <label for="title">Title</label>
    <input type="text" name="title" /></br>
    <label for="text">Text</label>
    <textarea name="text"></textarea><br>

    <input type="submit" name="submit" value="Create news item" />
    </form> -->

    <?php echo form_open('news/create'); ?>

    <label for="name">Name</label>
    <input type="text" name="name" require>
    <br>
    <label for="email">Email</label>
    <input type="email" name="email" require>
    <br>
    <label for="dob">Dob</label>
    <input type="date" name="dob" require>
    <br>
    <label for="gender">Gender</label>
    Male:<input type="radio" name="r1" value="male" require>
    Female:<input type="radio" name="r1" value="female" require>
    <br>
    <label for="password">Password</label>
    <input type="password" name="psw" require>
    <br>
    <label for="img">Image</label>
    <input type="file" name="img" require>
    <br>
