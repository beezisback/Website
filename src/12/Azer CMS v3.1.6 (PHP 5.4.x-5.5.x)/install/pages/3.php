<!---->
      <div class="content-header">
        <div class="chs">Install Step 3 of 3 Store, Paypal & Realm Settings</div>
      </div>
      
      <div class="content-body">
        <div class="cbsl">
        <form action="./?page=finish" method="post">
          <input type="hidden" name="pthost" value="{module.step_2.host1}">
          <input type="hidden" name="mshost" value="{module.step_2.host2}">
          <input type="hidden" name="msuser" value="{module.step_2.msuser}">
          <input type="hidden" name="mspass" value="{module.step_2.mspass}">
          <input type="hidden" name="cmsdb" value="{module.step_2.db1}">
          <input type="hidden" name="accdb" value="{module.step_2.db2}">
        
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">SOAP Host <span style="font-size:10px; font-weight:none;">(Domain or IP (Server) without the http:// or ending /).</span></td>
                  <td width="30%"><input type="text" name="soaphost" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">SOAP User <span style="font-size:10px; font-weight:none;">(Account will be given GM level 4).</span></td>
                  <td width="30%"><input type="text" name="soapuser" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">SOAP Password</td>
                  <td width="30%"><input type="password" name="soappass" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">Paypal Email</td>
                  <td width="30%"><input type="text" name="pemail" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">Paypal Currency</td>
                  <td width="30%"><select name="pcur" class="install"><option value="1">USD</option><option value="2">EURO</option></select></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">Realm Name</td>
                  <td width="30%"><input type="text" name="rname" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">Realm Description</td>
                  <td width="30%"><input type="text" name="rtype" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">Realm Character Database</td>
                  <td width="30%"><input type="text" name="rcdb" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">Realm Port</td>
                  <td width="30%"><input type="text" name="rport" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">Realm SOAP Port</td>
                  <td width="30%"><input type="text" name="soapport" class="install" AutoComplete="off"></td>
                </tr>
              </table>
            </div>
          </div>
          
          <div class="mc">
            <div style="padding:4px;">
              <table class="tblg" cellpadding="0" cellspacing="0">
                <tr id="head">
                  <td width="70%">Save & Continue</td>
                  <td width="30%"><input type="submit" name="save3" value="Install"></td>
                </tr>
              </table>
            </div>
          </div>
        </form>
        </div>
      </div>
      
      <div class="content-footer"></div>
<!---->