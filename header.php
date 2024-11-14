<div class="header">
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <div class="header-links">
        <a href="profile.php" class="btn">Profile Details</a>
        <a href="logout.php" class="btn">Logout</a>
    </div>
</div>

<style>
    .header {
        padding: 20px;
        background-color: #4CAF50;
        color: #fff;
        text-align: center;
        margin-left: 250px;
        position: relative;
    }

    .header-links {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .header-links .btn {
        background-color: #ffffff;
        color: #4CAF50;
        padding: 8px 15px;
        text-decoration: none;
        border-radius: 4px;
        margin-left: 10px;
    }

    .header-links .btn:hover {
        background-color: #45a049;
        color: #ffffff;
    }
</style>
