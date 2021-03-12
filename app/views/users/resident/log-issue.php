
<div data-collapse="medium" data-animation="default" data-duration="400" class="navbar w-nav">
  <div class="w-container">
    <nav role="navigation" class="w-nav-menu"><a href="#" class="navbtn w-button">Notifications</a></nav><a id="continue-button" class="nav-link w-nav-link">Home</a><a class="nav-link w-nav-link sign-out">Sign Out</a>
    <div class="w-nav-button">
      <div class="w-icon-nav-menu"></div>
    </div>
  </div>
</div>

<div class="hero-section">
  <div class="form-columns w-row">
    <div class="w-col w-col-5">
      <div class="form-card">
        <h1>AZ Preston Hall Maintenance System</h1>
        <h5>&gt;&gt;Log Issue</h5>
        <div class="form w-form">
          <form id="email-form" name="email-form" data-name="Email Form" class="w-clearfix"><input id="IDapp" type="text" class="w-input" maxlength="256" placeholder="id number" required="">
            <label for="name">Select your cluster</label>
            <select id="cluster" name="cluster" required="" data-name="cluster" class="w-select">
              <option value="AMSTERDAM">Amsterdam</option><option value="BELGIQUE">Belgique</option>
              <option value="BURGPLATZ">Burgplatz</option><option value="EINHEIT">Einheit</option>
              <option value="ITALIA">Italia</option><option value="LA MAISON">La Maison</option>
              <option value="LOS MATADORES">Los Matadores</option>
              <option value="OLIMPIA">Olimpia</option><option value="PORTO SANTO">Porto Santo</option>
              <option value="SHERWOOD MANOR">Sherwood Manor</option>
              <option value="REGENSEN">Regensen</option>
              <option value="SHAMROCK">Shamrock</option>
              <option value="VIKINGS">Vikings</option>
            </select>
            
            <label for="name">Issue category</label>
            <select id="classification" name="classification" required="" data-name="classification" class="w-select">
              <option value="ADMINISTRATIVE">Administrative</option>
              <option value="APPLIANCE">Appliance</option>
              <option value="ELECTRICAL">Electrical</option>
              <option value="FURNITURE">Furniture</option>
              <option value="INFRASTRUCTURE">Infrastructure</option>
              <option value="PLUMBING">Plumbing</option>
              <option value="ROOM FIXTURES">Room Fixtures</option>
            </select>
            
            <label for="Issue-description">Issue description</label>
            <input type="text" class="description-field w-input" maxlength="256" name="Issue-description" data-name="Issue description" placeholder="Give a short description of the issue..." id="Issue-description" required="">
            
            <h6>All Fields are Mandatory</h6>
            <input id="submit-issue" type="submit" value="Submit" data-wait="Please wait..." class="btn-filled blue w-button"></form>
          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>
    </div>
    <div class="w-col w-col-7"><img src="images/form-pic.png" srcset="images/form-pic-p-500.png 500w, images/form-pic.png 750w" sizes="(max-width: 479px) 67vw, (max-width: 767px) 79vw, 48vw" alt=""></div>
  </div>
</div>