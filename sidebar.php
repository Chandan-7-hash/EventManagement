<div class="sidebar">
    <h2>Dashboard</h2>
    <ul>
        <li><a href="user_dashboard.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="book_event.php"><i class="fas fa-calendar-plus"></i> Book Event</a></li>
        <li><a href="view_event_user.php"><i class="fas fa-cog"></i> View Event</a></li>
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
    /* Sidebar container */
    .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #1c1c1c;
        padding-top: 30px;
        color: #fff;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    /* Sidebar header */
    .sidebar h2 {
        text-align: center;
        color: #4CAF50;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    /* Sidebar navigation list */
    .sidebar ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    /* Sidebar navigation items */
    .sidebar ul li {
        width: 100%;
        margin: 5px 0;
    }

    /* Sidebar links */
    .sidebar ul li a {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        font-size: 1rem;
        color: #ddd;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    /* Sidebar link icons */
    .sidebar ul li a i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    /* Sidebar link hover effect */
    .sidebar ul li a:hover {
        background-color: #4CAF50;
        color: #fff;
        text-decoration: none;
    }
</style>
