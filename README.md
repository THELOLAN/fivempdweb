<h2 align="center">Police CAD</h2>

<p>We want to introduce you into our own police cad which comes with a lot of features for your rp. You may already know existing cad systems for fivem. This system doesnt interact directly with fivem. It takes the data of your database and shows it with a nice ui. The whole system is completly made by us. The design is a paid theme from <a href="https://themeforest.net" style="color: blue">themeforest.net</a>.</p>

<h2>Features</h2>
<ul>
    <li>
        Citizen database
        <ul>
            <li>Create a entry</li>
            <li>Delete the entry</li>
            <li>After you created a entry you'll get a total number of the imprisonment and the fine</li>
        </ul>
    </li>
    <li>
        Vehicle database
        <ul>
            <li>List of all registered vehicles on your server</li>
            <li>Create a manhunt for each vehicle</li>
        </ul>
    </li>
    <li>
        Laws
        <ul>
            <li>Create own laws, edit them or delete them if you dont need them</li>
        </ul>
    </li>
    <li>
        Penalties
        <ul>
            <li>Create, edit or delete them</li>
            <li>Penalties are neccessary to create a entry on a citizen</li>
            <li>Set the length of the imprisonment and set the fine</li>
        </ul>
    </li>
    <li>
        Control center
        <ul>
            <li>Create and delete areas</li>
            <li>Each officer can take over the control center and set officers at a area</li>
            <li>Set a limit of officers per each area</li>
        </ul>
    </li>
    <li>
        Instructions
        <ul>
            <li>Create, edit and delete instructions</li>
        </ul>
    </li>
    <li>
        Manhunts
        <ul>
            <li>Overview from all created manhunts</li>
        </ul>
    </li>
    <li>
        Investigations
        <ul>
            <li>Create, delete, edit and view investigations</li>
            <li>Create as many entries as you want in each investigation</li>
        </ul>
    </li>
    <li>
        Trainings
        <ul>
            <li>Create new trainings</li>
            <li>Set one or multiple roles as requirement to apply to them</li>
            <li>Set the status of each applied officer in the training</li>
            <li>Delete applied officer from training</li>
            <li>Close and reopen trainings</li>
        </ul>
    </li>
    <li>
        Officer
        <ul>
            <li>Create new officers</li>
            <li>Edit and delete existing officer</li>
            <li>Set the role of each officer</li>
            <li>Reset password if needed</li>
        </ul>
    </li>
</ul>

<h2 style="color: blue">Requirements</h5>
<ul>
    <li>
        Webserver
    </li>
    <li>
        PHP 8.0 or newer
    </li>
    <li>
        MYSQL Database
    </li>
    <li>
        FiveM Database
    </li>
    <li>
        NPM
    </li>
    <li>
        Composer
    </li>
    <li>
        Redis (recommended; optional)
    </li>
</ul>

<h2>FAQ</h2>
<dl>
    <dt>
        Which language has been used for this web application?
    </dt>
    <dd>
        I used vue.js in the frontend and PHP for the backend. I used the PHP Laravel Framework(v8.0) aswell to interact with the frontend.
    </dd>
</dl>
<dl>
    <dt>
        How can I install the police cad on my webserver?
    </dt>
    <dd>
        Please make sure that your webserver meets the requirements. Without that it will not work! <br />
        First of all upload the files up to your webserver. After that open https://plesk.com or create a new subdomain. You need to set the root folder in order to make the system navigate to the right folder and work well. <br />
        Lets say the path is the folowing:<br />
        <code>mywebsite.com/mysubdomain.mywebsite.com</code><br />
        Now add <code>/public</code> to the end of your path so it should looks like that: <code>mywebsite.com/mysubdomain.mywebsite.com/public</code> <br />
        Save your settings and open your subdomain in your browser.
        <br />
        <br />
        Now you need to setup your database credentials. I've provided a small setup to do that. Everything should be understandable. Please fill out the form correctly and safe your settings. <br />
        After you setup your database connection's you should now be able to open your subdomain in your browser. It should now show a login form. Keep in Mind - there is no registration form due to security purposes. Nobody except your officers should have login credentials to login into the cad.
        <br /><br />
        The default login credentials are:<br />
        <code>
        Username: <b>developer</b><br />
        Password: <b>developer2021</b><br />
            </code>
        <br />
        Please change the password as soon as you logged in into the cad. Use a strong and safe password to protect your developer account! Dont use the password you use anywhere else!<br /><br />
        That's it! You can now create new officer accounts and use all of the functions, I've mentioned above! 
    </dd>
    <dt>
        Can I customize the system?
    </dt>
    <dd>
        Yes. You can change everything as you want! 
    </dd>
    <dt>
        Do you provide any other systems?
    </dt>
    <dd>
        Yes. I provide a Medical system and mechanic system aswell. They're in the same design and have other functions, which you need for the type of their systems.
    </dd>
</dl>
