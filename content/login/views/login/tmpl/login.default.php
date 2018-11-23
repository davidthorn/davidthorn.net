<div class="login_container">
    
    <form action="/login" method="post">    
    <ul>
        
        <li>
            <label>Username:</label>
            <input type="text" name="jform[username]" value="<?php echo $this->getInput('UsernameText'); ?>" class="inputbox"/> 
        </li>
        
        <li>
            <label>Password:</label>
            <input type="password" name="jform[password]" value="<?php echo $this->getInput('PasswordText'); ?>" class="inputbox"/> 
        </li>
        
        <li>
            <input type="submit" name="login_submit" value="Login" class="inputbutton"/>
        </li>
        
        
    </ul>
       
    
        <input type="hidden" name="task" value="validate"/>
        
        
    </form>
    
</div>

