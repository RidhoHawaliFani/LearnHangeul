<?php
Class OnlineCashierEmailLibrary extends CI_Model{


  function sendProposalOpeningShop($user,$email){
  // load library email
        $this->load->library('PHPMailerAutoload');
        
        $mail = new PHPMailer();
        //$mail->SMTPDebug = 2;
        //$mail->Debugoutput = 'html';
        
        // set smtp
        $mail->isSMTP();
        $mail->Host = 'mx1.hostinger.co.id';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'cs_oc-noreply@munguinvest.com';
        $mail->Password = 'yUg4nt7rkx';
        $mail->WordWrap = 50;  
        // set email content
        $mail->setFrom('cs_oc-noreply@munguinvest.com', 'Online Cashier Head Quarter');
        $mail->addAddress($email, $user);
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachment
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML


        //Konten
        $mail->Subject = 'Permohonan Terkirim';
        $mail->Body = "<html>
  <head>
    <meta name='viewport' content='width=device-width' />
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Permohonan Mitra Telah Dikirim</title>
    <style>
     /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        font-size : 14px; line-height:17px;
        color:#666666; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px;
        font-size : 14px; line-height:24px;
        color:#666666; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        text-align: center;
        margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }

      a {
        color: #3498db;
        text-decoration: underline; }
        .spantang {
          font-size: 10px;

        }
      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #3498db; }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      .headers {
        padding: 20px;
        margin-bottom:-5px;
        background-color: #4398f8;
        text-align: center;
        font-weight: bold;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        color: #fff;
      }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }

    </style>
  </head>
  <body class=''>
    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
      <tr>
        <td>&nbsp;</td>
        <td class='container'>
          <div class='content'>

            <!-- START CENTERED WHITE CONTAINER -->
            
            <div class='headers'>Online Cashier | MUNGU™</div>
            <table role='presentation' class='main'>

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class='wrapper'>
                  <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                    
                    <tr>
                      <td>
                        <p>Hai Toko $user,</p>
                        <p style='text-align:justify'>Senang sekali Anda ingin bergabung dengan kami. Proposal pengajuan Anda sedang dipertimbangkan oleh tim penerimaan yang kami miliki, pemberitahuan akan disampaikan dalam waktu 2x24 jam. Semoga Anda sukses selalu.</p>
                        
                        <p style='text-align:left'>Apabila Anda memiliki pertanyaan atau keluhan, pastikan kami mengetahui hal tersebut.
                        
                        
                        <p>
                          Salam hangat,<br/><br/>Tim Penerimaan Pengajuan Proposal
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class='footer'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td class='content-block'>
                    <span class='apple-link'>Mungu Invest, Arcadia Village Paramount Serpong<br>Kelapa Dua, Tangerang, Banten 15810</span>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td class='content-block powered-by'>
                    Modified by <a href='#'>CTO Mungu</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  $mail->send();
  }

      function sendApprovalProposalOpeningShop($user,$email,$adminUser){
  // load library email
        $this->load->library('PHPMailerAutoload');
        
        $mail = new PHPMailer();
        //$mail->SMTPDebug = 2;
        //$mail->Debugoutput = 'html';
        
        // set smtp
        $mail->isSMTP();
        $mail->Host = 'mx1.hostinger.co.id';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'cs_oc-noreply@munguinvest.com';
        $mail->Password = 'yUg4nt7rkx';
        $mail->WordWrap = 50;  
        // set email content
        $mail->setFrom('cs_oc-noreply@munguinvest.com', 'Online Cashier Head Quarter');
        $mail->addAddress($email, $user);
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachment
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML


        //Konten
        $mail->Subject = 'Permohonan Diterima';
        $mail->Body = "<html>
  <head>
    <meta name='viewport' content='width=device-width' />
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Penerimaan Permohonan Menjadi Mitra</title>
    <style>
     /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        font-size : 14px; line-height:17px;
        color:#666666; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px;
        font-size : 14px; line-height:24px;
        color:#666666; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        text-align: center;
        margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }

      a {
        color: #3498db;
        text-decoration: underline; }
        .spantang {
          font-size: 10px;

        }
      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #3498db; }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      .headers {
        padding: 20px;
        margin-bottom:-5px;
        background-color: #4398f8;
        text-align: center;
        font-weight: bold;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        color: #fff;
      }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }

    </style>
  </head>
  <body class=''>
    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
      <tr>
        <td>&nbsp;</td>
        <td class='container'>
          <div class='content'>

            <!-- START CENTERED WHITE CONTAINER -->
            
            <div class='headers'>Online Cashier | MUNGU™</div>
            <table role='presentation' class='main'>

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class='wrapper'>
                  <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                    
                    <tr>
                      <td>
                        <p>Hai Toko $user,</p>
                        <p style='text-align:justify'><b>Selamat!</b> Permohonan Anda telah kami terima.<br/>
                        Setelah melewati beberapa pertimbangan yang telah kami lakukan, Toko Anda berhak untuk dapat melakukan aktifitas transaksi pada sistem ini. Berikut informasi penting yang dapat kami sampaikan :<br/></p><br/>

                        <p style='text-align:left'>Shop name login : <b>$user</b></p>
                        <p style='text-align:left'>Username login : <b>$adminUser</b></p>
                        <p style='text-align:left'>Email login : <b>$email</b></p>
                        

                        <br/>

                        <p style='text-align:left'>Apabila Anda memiliki pertanyaan atau keluhan, pastikan kami mengetahui hal tersebut.
                        
                        
                        <p>
                          Salam hangat,<br/><br/>Tim Penerimaan Pengajuan Proposal
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class='footer'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td class='content-block'>
                    <span class='apple-link'>Mungu Invest, Arcadia Village Paramount Serpong<br>Kelapa Dua, Tangerang, Banten 15810</span>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td class='content-block powered-by'>
                    Modified by <a href='#'>CTO Mungu</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  $mail->send();
  }



      function sendDeclineRequestJoinSiswa($email,$user){
  // load library email
        $this->load->library('PHPMailerAutoload');
        
        $mail = new PHPMailer();
        //$mail->SMTPDebug = 2;
        //$mail->Debugoutput = 'html';
        
        // set smtp
        $mail->isSMTP();
        $mail->Host = 'mx1.hostinger.co.id';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'no-reply@munguinvest.com';
        $mail->Password = 'fe4Kuks64R1i';
        $mail->WordWrap = 50;  
        // set email content
        $mail->setFrom('no-reply@munguinvest.com', 'Mungu Team');
        $mail->addAddress($email, $user);
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachment
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML


        //Konten
        $mail->Subject = 'Permohonan Ditolak';
        $mail->Body = "<html>
  <head>
    <meta name='viewport' content='width=device-width' />
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Penerimaan Permohonan Menjadi Siswa</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        font-size : 14px; line-height:17px;
        color:#666666; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px;
        font-size : 14px; line-height:24px;
        color:#666666; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        text-align: center;
        margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }

      a {
        color: #3498db;
        text-decoration: underline; }
        .spantang {
          font-size: 10px;

        }
      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #3498db; }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      .headers {
        padding: 20px;
        margin-bottom:-5px;
        background-color: #4398f8;
        text-align: center;
        font-weight: bold;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        color: #fff;
      }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }

    </style>
  </head>
  <body class=''>
    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
      <tr>
        <td>&nbsp;</td>
        <td class='container'>
          <div class='content'>

            <!-- START CENTERED WHITE CONTAINER -->
            
            <div class='headers'>MUNGU™</div>
            <table role='presentation' class='main'>

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class='wrapper'>
                  <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                    
                    <tr>
                      <td>
                        <p>Hai $user,</p>
                        <p style='text-align:left'>Terima kasih atas minat Anda pada perusahaan kami dan telah meluangkan waktu untuk mendaftar menjadi siswa! Kami ingin meluangkan waktu untuk memberi Anda umpan balik tentang permohona Anda.
                          Setelah memeriksa permohona Anda, kualitas permohonan yang Anda sajikan saat ini tidak sesuai dengan standar yang kami tetapkan untuk komunitas kami. Namun, dengan sedikit waktu, kami pikir pekerjaan Anda dapat meningkat dan berubah menjadi hal yang menjanjikan dan akan berhasil di perusahaan ini.</p>
                        
                        <p style='text-align:left'>
                          Berikut ini beberapa tips untuk membantu permohonan Anda diterima nantinya :
                          <br/>
                          1. Tampilkan deskripsi tempat usaha yang telah berhasil Anda kembangkan<br/>
                          2. Tunjukkan bagaimana produk Anda akan menarik bagi investor<br/>
                          3. Berikan data yang valid dan aktual terkait usaha Anda saat ini.<br/>
                          <br/>
                          

                          Harap dicatat bahwa jika Anda berencana mengajukan kembali, kami tidak akan dapat menerima Anda jika Anda mengirimkan portofolio yang sama. Ikuti panduan di atas, pastikan Anda mengedepankan pekerjaan terbaik Anda, dan memperbarui portofolio Anda. Saat Anda siap, silakan kirim kembali permohonan Anda dengan mengisi formulir ini lagi.
                        </p>
                        <p class='spantang'>Catatan : Harap jangan beritahu password Anda kepada orang yang tidak dikenal.</p>
                        
                        <p>
                          Salam hangat,<br/><br/>Tim IT Mungu
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class='footer'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td class='content-block'>
                    <span class='apple-link'>Mungu Invest, Arcadia Village Paramount Serpong<br>Kelapa Dua, Tangerang, Banten 15810</span>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td class='content-block powered-by'>
                    Modified by <a href='http://htmlemail.io'>CTO Mungu</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  $mail->send();
  }

        function verifyEmailAddress($verificationCode){
                $result = "update identitas set activeStatus= 'A' WHERE verificationCode =?";
                $this->db->query($result, array($verificationCode));
                return $this->db->affected_rows();
        }

        function sendForgotPass($email,$verificationCode,$username){
        // load library email
        $this->load->library('PHPMailerAutoload');
        
        $mail = new PHPMailer();
        //$mail->SMTPDebug = 2;
        //$mail->Debugoutput = 'html';
        
        // set smtp
        $mail->isSMTP();
        $mail->Host = 'mx1.hostinger.co.id';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'no-reply@munguinvest.com';
        $mail->Password = 'fe4Kuks64R1i';
        $mail->WordWrap = 50;  
        // set email content
        $mail->setFrom('no-reply@munguinvest.com', 'Mungu Team');
        $mail->addAddress($email, $username);
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachment
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        //Konten
        $mail->Subject = 'Reset Password';
        $mail->Body = "
        <html>
  <head>
    <meta name='viewport' content='width=device-width' />
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title>Simple Transactional Email</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.7;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #ffffff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .content-block {
        padding-bottom: 10px;
        padding-top: 10px;
      }

      .footer {
        clear: both;
        Margin-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        margin-bottom: 30px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        text-align: center;
        margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }

      a {
        color: #3498db;
        text-decoration: underline; }
        .spantang {
          font-size: 10px;

        }
      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td  {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #3498db; }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      .headers {
        padding: 20px;
        margin-bottom:-5px;
        background-color: #4398f8;
        text-align: center;
        font-weight: bold;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        color: #fff;
      }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }

    </style>
  </head>
  <body class=''>
    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
      <tr>
        <td>&nbsp;</td>
        <td class='container'>
          <div class='content'>

            <!-- START CENTERED WHITE CONTAINER -->
            <span class='preheader'>Reset Password</span>
            <div class='headers'>MUNGU™</div>
            <table role='presentation' class='main'>

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class='wrapper'>
                  <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                    
                    <tr>
                      <td>
                        <p>Hai $username,</p>
                        <p>Silahkan klik tombol dibawah ini untuk melanjutkan reset password Anda.</p>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary'>
                          <tbody>
                            <tr>
                              <td align='center'>
                                <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                                  <tbody>
                                    <tr>
                                      <td><center> <a href='localhost/mungusite/Forgot/reset/$verificationCode' target='_blank'>Reset Password</a></center> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p class='spantang'>Catatan : Harap jangan beritahu password Anda kepada orang yang tidak dikenal.</p>
                        
                        <p>
                          Salam hangat,<br/><br/>Tim IT Mungu
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class='footer'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                <tr>
                  <td class='content-block'>
                    <span class='apple-link'>Mungu Invest, Arcadia Village Paramount Serpong<br>Kelapa Dua, Tangerang, Banten 15810</span>
                    <br>
                  </td>
                </tr>
                <tr>
                  <td class='content-block powered-by'>
                    Modified by <a href='http://htmlemail.io'>CTO Mungu</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        }

        function verifyPassword($verificationCode){
                $result = "update identitas set activeStatusForgotPass = 'A' WHERE verificationCodeForgotPass =?";
                $this->db->query($result, array($verificationCode));
                return $this->db->affected_rows();
        }

        function sendEmailByHQSent($alamatEmail,$namaPengirimEmail,$subjectEmail,$isiEmail){
              // load library email
              $this->load->library('PHPMailerAutoload');
              
              $mail = new PHPMailer();
              //$mail->SMTPDebug = 2;
              //$mail->Debugoutput = 'html';
              
              // set smtp
              $mail->isSMTP();
              $mail->Host = 'mx1.hostinger.co.id';
              $mail->Port = 587;
              $mail->SMTPAuth = true;
              $mail->SMTPSecure = 'tls';
              $mail->Username = 'cs_oc-noreply@munguinvest.com';
              $mail->Password = 'yUg4nt7rkx';
              $mail->WordWrap = 50;  
              // set email content
              $mail->setFrom('cs_oc-noreply@munguinvest.com', 'Online Cashier Head Quarter');
              $mail->addAddress($alamatEmail, $namaPengirimEmail);
              //$mail->addReplyTo('info@example.com', 'Information');
              //$mail->addCC('cc@example.com');
              //$mail->addBCC('bcc@example.com');

              //Attachment
              //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
              //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
              $mail->isHTML(true);                                  // Set email format to HTML


              //Konten
              $mail->Subject = $subjectEmail;
              $mail->Body = "<html>
        <head>
          <meta name='viewport' content='width=device-width' />
          <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
          <title>Penerimaan Permohonan Menjadi Siswa</title>
          <style>
            /* -------------------------------------
                GLOBAL RESETS
            ------------------------------------- */
            img {
              border: none;
              -ms-interpolation-mode: bicubic;
              max-width: 100%; }

            body {
              background-color: #f6f6f6;
              font-family: sans-serif;
              -webkit-font-smoothing: antialiased;
              font-size: 14px;
              line-height: 1.7;
              margin: 0;
              padding: 0;
              -ms-text-size-adjust: 100%;
              -webkit-text-size-adjust: 100%;
              font-size : 14px; line-height:17px;
              color:#666666; }

            table {
              border-collapse: separate;
              mso-table-lspace: 0pt;
              mso-table-rspace: 0pt;
              width: 100%; }
              table td {
                font-family: sans-serif;
                font-size: 14px;
                vertical-align: top; }

            /* -------------------------------------
                BODY & CONTAINER
            ------------------------------------- */

            .body {
              background-color: #f6f6f6;
              width: 100%; }

            /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
            .container {
              display: block;
              Margin: 0 auto !important;
              /* makes it centered */
              max-width: 580px;
              padding: 10px;
              width: 580px;
              font-size : 14px; line-height:24px;
              color:#666666; }

            /* This should also be a block element, so that it will fill 100% of the .container */
            .content {
              box-sizing: border-box;
              display: block;
              Margin: 0 auto;
              max-width: 580px;
              padding: 10px; }

            /* -------------------------------------
                HEADER, FOOTER, MAIN
            ------------------------------------- */
            .main {
              background: #ffffff;
              border-radius: 3px;
              width: 100%; }

            .wrapper {
              box-sizing: border-box;
              padding: 20px; }

            .content-block {
              padding-bottom: 10px;
              padding-top: 10px;
            }

            .footer {
              clear: both;
              Margin-top: 10px;
              text-align: center;
              width: 100%; }
              .footer td,
              .footer p,
              .footer span,
              .footer a {
                color: #999999;
                font-size: 12px;
                text-align: center; }

            /* -------------------------------------
                TYPOGRAPHY
            ------------------------------------- */
            h1,
            h2,
            h3,
            h4 {
              color: #000000;
              font-family: sans-serif;
              font-weight: 400;
              line-height: 1.4;
              margin: 0;
              margin-bottom: 30px; }

            h1 {
              font-size: 35px;
              font-weight: 300;
              text-align: center;
              text-transform: capitalize; }

            p,
            ul,
            ol {
              font-family: sans-serif;
              font-size: 14px;
              font-weight: normal;
              margin: 0;
              text-align: center;
              margin-bottom: 15px; }
              p li,
              ul li,
              ol li {
                list-style-position: inside;
                margin-left: 5px; }

            a {
              color: #3498db;
              text-decoration: underline; }
              .spantang {
                font-size: 10px;

              }
            /* -------------------------------------
                BUTTONS
            ------------------------------------- */
            .btn {
              box-sizing: border-box;
              width: 100%; }
              .btn > tbody > tr > td {
                padding-bottom: 15px; }
              .btn table {
                width: auto; }
              .btn table td {
                background-color: #ffffff;
                border-radius: 5px;
                text-align: center; }
              .btn a {
                background-color: #ffffff;
                border: solid 1px #3498db;
                border-radius: 5px;
                box-sizing: border-box;
                color: #3498db;
                cursor: pointer;
                display: inline-block;
                font-size: 14px;
                font-weight: bold;
                margin: 0;
                padding: 12px 25px;
                text-decoration: none;
                text-transform: capitalize; }

            .btn-primary table td {
              background-color: #3498db; }

            .btn-primary a {
              background-color: #3498db;
              border-color: #3498db;
              color: #ffffff; }

            /* -------------------------------------
                OTHER STYLES THAT MIGHT BE USEFUL
            ------------------------------------- */
            .last {
              margin-bottom: 0; }

            .first {
              margin-top: 0; }

            .align-center {
              text-align: center; }

            .align-right {
              text-align: right; }

            .align-left {
              text-align: left; }

            .clear {
              clear: both; }

            .mt0 {
              margin-top: 0; }

            .mb0 {
              margin-bottom: 0; }

            .preheader {
              color: transparent;
              display: none;
              height: 0;
              max-height: 0;
              max-width: 0;
              opacity: 0;
              overflow: hidden;
              mso-hide: all;
              visibility: hidden;
              width: 0; }

            .powered-by a {
              text-decoration: none; }

            hr {
              border: 0;
              border-bottom: 1px solid #f6f6f6;
              Margin: 20px 0; }

            .headers {
              padding: 20px;
              margin-bottom:-5px;
              background-color: #4398f8;
              text-align: center;
              font-weight: bold;
              border-top-left-radius: 10px;
              border-top-right-radius: 10px;
              color: #fff;
            }

            /* -------------------------------------
                RESPONSIVE AND MOBILE FRIENDLY STYLES
            ------------------------------------- */
            @media only screen and (max-width: 620px) {
              table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important; }
              table[class=body] p,
              table[class=body] ul,
              table[class=body] ol,
              table[class=body] td,
              table[class=body] span,
              table[class=body] a {
                font-size: 16px !important; }
              table[class=body] .wrapper,
              table[class=body] .article {
                padding: 10px !important; }
              table[class=body] .content {
                padding: 0 !important; }
              table[class=body] .container {
                padding: 0 !important;
                width: 100% !important; }
              table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important; }
              table[class=body] .btn table {
                width: 100% !important; }
              table[class=body] .btn a {
                width: 100% !important; }
              table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important; }}

            /* -------------------------------------
                PRESERVE THESE STYLES IN THE HEAD
            ------------------------------------- */
            @media all {
              .ExternalClass {
                width: 100%; }
              .ExternalClass,
              .ExternalClass p,
              .ExternalClass span,
              .ExternalClass font,
              .ExternalClass td,
              .ExternalClass div {
                line-height: 100%; }
              .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important; }
              .btn-primary table td:hover {
                background-color: #34495e !important; }
              .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important; } }

          </style>
        </head>
        <body class=''>
          <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body'>
            <tr>
              <td>&nbsp;</td>
              <td class='container'>
                <div class='content'>

                  <!-- START CENTERED WHITE CONTAINER -->
                  
                  <div class='headers'>MUNGU™</div>
                  <table role='presentation' class='main'>

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                      <td class='wrapper'>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                          
                          <tr>
                            <td>
                              <p style='text-align:left'>Hai saya $namaPengirimEmail,</p>
                              <p style='text-align:left'>$isiEmail</p>
                              
                              
                              <p class='spantang'>Catatan : Harap jangan beritahu password Anda kepada orang yang tidak dikenal.</p>
                              
                              <p>
                                Salam hangat,<br/><br/>$namaPengirimEmail
                              </p>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>

                  <!-- END MAIN CONTENT AREA -->
                  </table>

                  <!-- START FOOTER -->
                  <div class='footer'>
                    <table role='presentation' border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td class='content-block'>
                          <span class='apple-link'>Mungu Invest, Arcadia Village Paramount Serpong<br>Kelapa Dua, Tangerang, Banten 15810</span>
                          <br>
                        </td>
                      </tr>
                      <tr>
                        <td class='content-block powered-by'>
                          Modified by <a href='http://htmlemail.io'>CTO Mungu</a>.
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- END FOOTER -->

                <!-- END CENTERED WHITE CONTAINER -->
                </div>
              </td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </body>
      </html>";
              //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        }

	}
?>