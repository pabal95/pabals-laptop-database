<div class="welcome-container" style="height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="detail-card" style="width: 100%; max-width: 400px; padding: 3rem 2rem;">
        <div style="text-align: center; margin-bottom: 2rem;">
            <h2 style="color: #cdd6f4; font-size: 1.8rem; margin: 0;">Pabal's Laptops</h2>
            <p style="color: #a6accd; font-size: 0.9rem; margin-top: 0.5rem;">Enterprise Inventory System</p>
        </div>
        
        <form action="index.php" method="post" class="modern-form">
    <!-- This tells index.php to load validate.inc.php -->
    <input type="hidden" name="content" value="validate">
    
    <div class="form-grid" style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div class="input-group full-width">
            <label>Email Address</label>
            <!-- Changed name to match what your script expects -->
            <input type="email" name="email_address" required autofocus style="width: 100%;">
        </div>
        
        <div class="input-group full-width">
            <label>Password</label>
            <input type="password" name="password" required style="width: 100%;">
        </div>
    </div>
    
    <div class="form-actions" style="margin-top: 2.5rem; justify-content: center;">
        <button type="submit" class="btn btn-update" style="width: 100%; padding: 1rem; font-size: 1.1rem;">Secure Login</button>
    </div>
</form>