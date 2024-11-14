<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Admin Dashboard</h2>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li><a href="admin_dashboard.php" class="sidebar-link">Dashboard</a></li>
            <li><a href="manage_users.php" class="sidebar-link">Manage Users</a></li>
            <li><a href="add_event.php" class="sidebar-link">Add Event</a></li> <!-- Link to add new event -->
            <li><a href="manage_events.php" class="sidebar-link">Manage Events</a></li> <!-- Link to manage events -->
            <li><a href="view_events.php" class="sidebar-link">View Events</a></li><!-- Link to add new event -->
            <li><a href="all_ticket_report.php" class="sidebar-link">Ticket Informations</a></li>
            <li><a href="logout.php" class="sidebar-link">Logout</a></li>
        </ul>
    </nav>
</aside>

<style>
    /* Sidebar Style */
    .sidebar {
        width: 250px;
        height: 100%;
        background-color: #2c3e50;
        color: white;
        position: fixed;
        left: 0;
        top: 0;
        padding-top: 20px;
    }

    .sidebar-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .sidebar-header h2 {
        color: white;
    }

    .sidebar-nav ul {
        list-style: none;
        padding: 0;
    }

    .sidebar-nav ul li {
        margin: 20px 0;
    }

    .sidebar-link {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px;
        font-size: 18px;
    }

    .sidebar-link:hover {
        background-color: #34495e;
        border-radius: 5px;
    }
</style>
