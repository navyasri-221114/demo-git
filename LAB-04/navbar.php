<!-- NAVBAR -->
<div class="navbar">
    <a href="../LAB-02/index.html">Home</a>
    <a href="../LAB-02/about.html">About</a>
    <a href="../LAB-02/community.html">Community</a>
    <a href="../LAB-02/courses.html">Courses</a>
    <a href="../LAB-02/admissions.html">Admissions</a>
    <a href="../LAB-02/contact.html">Contact</a>
    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <span style="color: #aef; font-weight: bold; padding: 0 10px;">👤 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <a href="logout.php" style="color: #ff6b6b; font-weight: bold;">Logout</a>
    <?php else: ?>
        <a href="login.php" <?php if(basename($_SERVER['PHP_SELF']) == 'login.php') echo 'style="color: yellow; font-weight: bold;"'; ?>>Login</a>
        <a href="register.php" <?php if(basename($_SERVER['PHP_SELF']) == 'register.php') echo 'style="color: yellow; font-weight: bold;"'; ?>>Register</a>
    <?php endif; ?>
</div>
