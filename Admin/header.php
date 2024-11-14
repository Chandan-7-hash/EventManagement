<div class="header">
    <div class="header-container">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <div class="header-right">
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<style>
    .header {
        padding: 20px;
        background-color: #34495E;
        color: white;
        position: fixed;
        top: 0;
        left: 250px; /* Ensures header starts from the right side of sidebar */
        right: 0; /* Extends header to the right edge */
        z-index: 9999;
        box-sizing: border-box;
    }
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        overflow: hidden; /* Prevents accidental overflow */
        width: 100%; /* Ensures container uses full header width */
    }
    .header h1 {
        margin: 0;
        font-size: 24px;
        white-space: nowrap;
    }
    .header-right {
        display: flex;
        align-items: center;
        overflow: hidden; /* Prevents overflow of links */
    }
    .header-right a {
        color: #BDC3C7;
        margin-left: 20px;
        text-decoration: none;
        white-space: nowrap;
    }
    .header-right a:hover {
        color: #fff;
    }
</style>
