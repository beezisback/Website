{module.step_1.tables}
<!---->
      <div class="content-header">
        <div class="chs">Install Step 2 of 3 Global Settings</div>
      </div>
      
      <div class="content-body">
        <div class="cbsl">
        {module.step_1.connect}{module.step_1.con1}{module.step_1.con2}
        <form action="./?page=3" method="post">
          <input type="hidden" name="pthost" value="{module.step_1.host1}">
          <input type="hidden" name="mshost" value="{module.step_1.host2}">
          <input type="hidden" name="msuser" value="{module.step_1.msuser}">
          <input type="hidden" name="mspass" value="{module.step_1.mspass}">
          <input type="hidden" name="cmsdb" value="{module.step_1.db1}">
          <input type="hidden" name="accdb" value="{module.step_1.db2}">
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Title:</b> The global website title.</td>
                  <td width="30%"><input type="text" name="global_title" value="" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Email Activation:</b> Should registration require email activation?</td>
                  <td width="30%"><select name="email_act" class="install"><option value="1">Yes</option><option value="0">No</option></select></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Login:</b> Should the login system be enabled or disabled?</td>
                  <td width="30%"><select name="login" class="install"><option value="1">Enabled</option><option value="0">Disabled</option></select></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Copyright:</b> Your server's name for website copyright settings.</td>
                  <td width="30%"><input type="text" name="cright" value="" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Realmlist:</b> Your server's realmlist.</td>
                  <td width="30%"><input type="text" name="realm" value="" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Server Email:</b> Email Address used to send emails from the website to users.</td>
                  <td width="30%"><input type="text" name="semail" value="" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Domain:</b> Your server's domain without http://.</td>
                  <td width="30%"><input type="text" name="domain" value="" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Server Title:</b> Your server's name for email topics/subjects.</td>
                  <td width="30%"><input type="text" name="stitle" value="" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Expansion:</b> Which expansion should your users be registered with?</td>
                   <td width="30%"><select name="expansion" class="install"><option value="2">Wrath of the Lich King</option><option value="3">Cataclysm</option><option value="4">Mists of Pandaria</option></select></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:3px 0px 2px 0px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%"><b>Save & Continue</b></td>
                  <td width="30%"><input type="submit" name="save2" value="Continue"></td>
                </tr>
              </table>
            </div>
          </div>
        </form>
        </div>
      </div>
      
      <div class="content-footer"></div>
<!---->