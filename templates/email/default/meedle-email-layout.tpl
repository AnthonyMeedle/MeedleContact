{default_translation_domain domain='meedlecontact'}
{default_locale locale={$locale}}
{declare_assets directory='assets'}
{assign var="url_site" value="{config key="url_site"}"}
{assign var="company_name" value="{config key="store_name"}"}
{if not $company_name}
    {assign var="company_name" value="{intl l='Thelia V2'}"}
{/if}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
  <title>{block name="email-title"}{/block}</title>
	  </style>
{hook name="email-html.layout.css"}
</head>
{literal}
	  <style>/**
  * IMPORTANT:
  * Please read before changing anything, CSS involved in our HTML emails is
  * extremely specific and written a certain way for a reason. It might not make
  * sense in a normal setting but Outlook loves it this way.
  *
  * !!! [override] prevents Yahoo Mail breaking media queries. It must be used
  * !!! at the beginning of every line of CSS inside a media query.
  * !!! Do not remove.
  *
  * !!! div[style*="margin: 16px 0"] allows us to target a weird margin
  * !!! bug in Android's email client.
  * !!! Do not remove.
  *
  * Also, the img files are hosted on S3. Please don't break these URLs!
  * The images are also versioned by date, so please update the URLs accordingly
  * if you create new versions
  *
***/


/**
  * # Root
  * - CSS resets and general styles go here.
**/

html, body,
a, span, div[style*="margin: 16px 0"] {
  border: 0 !important;
  margin: 0 !important;
  outline: 0 !important;
  padding: 0 !important;
  text-decoration: none !important;
}

a, span,
td, th {
  -webkit-font-smoothing: antialiased !important;
  -moz-osx-font-smoothing: grayscale !important;
}

/**
  * # Delink
  * - Classes for overriding clients which creates links out of things like
  *   emails, addresses, phone numbers, etc.
**/

span.st-Delink a {
  color: #525f7f !important;
  text-decoration: none !important;
}

/** Modifier: preheader */
span.st-Delink.st-Delink--preheader a {
  color: white !important;
  text-decoration: none !important;
}
/** */

/** Modifier: title */
span.st-Delink.st-Delink--title a {
  color: #32325d !important;
  text-decoration: none !important;
}
/** */

/** Modifier: footer */
span.st-Delink.st-Delink--footer a {
  color: #8898aa !important;
  text-decoration: none !important;
}
/** */

/**
  * # Header
**/

table.st-Header td.st-Header-background div.st-Header-area {
  height: 76px !important;
  width: 600px !important;
  background-repeat: no-repeat !important;
  background-size: 600px 76px !important;
}

table.st-Header td.st-Header-logo div.st-Header-area {
  height: 21px !important;
  width: 49px !important;
  background-repeat: no-repeat !important;
  background-size: 49px 21px !important;
}


table.st-Header td.st-Header-logo.st-Header-logo--atlasAzlo div.st-Header-area {
  height: 21px !important;
  width: 216px !important;
  background-repeat: no-repeat !important;
  background-size: 216px 21px !important;
}


/**
  * # Retina
  * - Targets high density displays and devices smaller than 768px.
  *
  * ! For mobile specific styling, see `# Mobile`.
**/

@media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi), all and (max-width: 768px) {

  /**
    * # Target
    * - Hides images in these devices to display the larger version as a
    *   background image instead.
  **/

  /** Modifier: mobile */
  body[override] div.st-Target.st-Target--mobile img {
    display: none !important;
    margin: 0 !important;
    max-height: 0 !important;
    min-height: 0 !important;
    mso-hide: all !important;
    padding: 0 !important;
    font-size: 0 !important;
    line-height: 0 !important;
  }
  /** */

  /**
    * # Header
  **/

  body[override] table.st-Header td.st-Header-background div.st-Header-area {
    background-image: url("{image file='assets/img/Header-background.png' source="MeedleContact"}") !important;
  }

  /** Modifier: white */
  body[override] table.st-Header.st-Header--white td.st-Header-background div.st-Header-area {
    background-image: url("{image file='assets/img/Header-background--white.png' source="MeedleContact"}") !important;
  }
  /** */

}

/**
  * # Mobile
  * - This affects emails views in clients less than 600px wide.
**/

@media all and (max-width: 600px) {

  /**
    * # Wrapper
  **/

  body[override] table.st-Wrapper,
  body[override] table.st-Width.st-Width--mobile {
    min-width: 100% !important;
    width: 100% !important;
  }

  /**
    * # Spacer
  **/

  /** Modifier: gutter */
  body[override] td.st-Spacer.st-Spacer--gutter {
    width: 32px !important;
  }
  /** */

  /** Modifier: kill */
  body[override] td.st-Spacer.st-Spacer--kill {
    width: 0 !important;
  }
  /** */

  /** Modifier: emailEnd */
  body[override] td.st-Spacer.st-Spacer--emailEnd {
    height: 32px !important;
  }
  /** */

  /**
    * # Font
  **/

  /** Modifier: title */
  body[override] td.st-Font.st-Font--title,
  body[override] td.st-Font.st-Font--title span,
  body[override] td.st-Font.st-Font--title a {
    font-size: 28px !important;
    line-height: 36px !important;
  }
  /** */

  /** Modifier: header */
  body[override] td.st-Font.st-Font--header,
  body[override] td.st-Font.st-Font--header span,
  body[override] td.st-Font.st-Font--header a {
    font-size: 24px !important;
    line-height: 32px !important;
  }
  /** */

  /** Modifier: body */
  body[override] td.st-Font.st-Font--body,
  body[override] td.st-Font.st-Font--body span,
  body[override] td.st-Font.st-Font--body a {
    font-size: 18px !important;
    line-height: 28px !important;
  }
  /** */

  /** Modifier: caption */
  body[override] td.st-Font.st-Font--caption,
  body[override] td.st-Font.st-Font--caption span,
  body[override] td.st-Font.st-Font--caption a {
    font-size: 14px !important;
    line-height: 20px !important;
  }
  /** */

  /**
    * # Header
  **/
  body[override] table.st-Header td.st-Header-background div.st-Header-area {
    margin: 0 auto !important;
    width: auto !important;
    background-position: 0 0 !important;
  }

  body[override] table.st-Header td.st-Header-background div.st-Header-area {
    background-image: url("{image file='assets/img/Header-background--mobile.png' source="MeedleContact"}") !important;
  }

  /** Modifier: white */
  body[override] table.st-Header.st-Header--white td.st-Header-background div.st-Header-area {
    background-image: url("{image file='assets/img/Header-background--white--mobile.png' source="MeedleContact"}") !important;
  }
  /** */

  /** Modifier: simplified */
  body[override] table.st-Header.st-Header--simplified td.st-Header-logo {
    width: auto !important;
  }

  body[override] table.st-Header.st-Header--simplified td.st-Header-spacing {
    width: 0 !important;
  }

  body[override] table.st-Header.st-Header--simplified td.st-Header-logo div.st-Header-area {
    margin: 0 auto !important;
  }

  body[override] table.st-Header.st-Header--simplified td.st-Header-logo.st-Header-logo--atlasAzlo div.st-Header-area {
    margin: 0 auto !important;
  }
  /** */

  /**
    * # Divider
  **/

  body[override] table.st-Divider td.st-Spacer.st-Spacer--gutter,
  body[override] tr.st-Divider td.st-Spacer.st-Spacer--gutter {
    background-color: #e6ebf1;
  }

  /**
    * # Blocks
  **/

  body[override] table.st-Blocks table.st-Blocks-inner {
      border-radius: 0 !important;
  }

  body[override] table.st-Blocks table.st-Blocks-inner table.st-Blocks-item td.st-Blocks-item-cell {
      display: block !important;
  }

  /**
    * # Hero Units
  **/

  /* Hides dividers in hero units so that vertical spacing remains consistent */
  body[override] table.st-Hero-Container td.st-Spacer--divider {
    display: none !important;
    margin: 0 !important;
    max-height: 0 !important;
    min-height: 0 !important;
    mso-hide: all !important;
    padding: 0 !important;

    font-size: 0 !important;
    line-height: 0 !important;
  }

  body[override] table.st-Hero-Responsive {
    margin: 16px auto !important;
  }

  /**
    * # Button
  **/

  body[override] table.st-Button {
      margin: 0 auto !important;
      width: 100% !important;
  }

  body[override] table.st-Button td.st-Button-area,
  body[override] table.st-Button td.st-Button-area a.st-Button-link,
  body[override] table.st-Button td.st-Button-area span.st-Button-internal {
    height: 44px !important;
    line-height: 44px !important;
    font-size: 18px !important;
    vertical-align: middle !important;
  }
}

@media (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi), all and (max-width: 768px) {

  /**
    * # mobile image
   **/
  body[override] div.st-Target.st-Target--mobile img {
    display: none !important;
    margin: 0 !important;
    max-height: 0 !important;
    min-height: 0 !important;
    mso-hide: all !important;
    padding: 0 !important;

    font-size: 0 !important;
    line-height: 0 !important;
  }

  /**
    * # document-list-item image
   **/
  body[override] div.st-Icon.st-Icon--document {

  }
}
</style>
{/literal}
</head>
  <body class="st-Email" bgcolor="f6f9fc" style="border: 0; margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; min-width: 100%; width: 100%;" override="fix">

    <!-- Background -->
    <table class="st-Background" bgcolor="f6f9fc" border="0" cellpadding="0" cellspacing="0" width="100%" style="border: 0; margin: 0; padding: 0;">
      <tbody>
        <tr>
          <td style="border: 0; margin: 0; padding: 0;">

            <!-- Wrapper -->
            <table class="st-Wrapper" align="center" bgcolor="ffffff" border="0" cellpadding="0" cellspacing="0" width="600" style="border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; margin: 0 auto; min-width: 600px;">
              <tbody>
                <tr>
                  <td style="border: 0; margin: 0; padding: 0;">
                  

  <table class="st-Preheader st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
  <tbody>
    <tr>
      <td align="center" height="0" style="border: 0; margin: 0; padding: 0; color: #ffffff; display: none !important; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all !important; opacity: 0; overflow: hidden; visibility: hidden;">
        <span class="st-Delink st-Delink--preheader" style="color: #ffffff; text-decoration: none;">

          	{block name="email-subject"}{/block}
			{block name="email-title"}{config key="store_name"}{/block}
  

          <!-- Prevents elements showing up in email client preheader text -->
          ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ 
          <!-- /Prevents elements showing up in email client preheader text -->

        </span>
      </td>
    </tr>
  </tbody>
</table>

  <div style="background-color:#f6f9fc; padding-top:20px;">
    <table dir="ltr" class="Section Header" width="100%" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;background-color: #ffffff;">
      <tbody>
      <tr>
        <td class="Header-left Target" style="background-color: #11b7f5; border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-size: 0;line-height: 0px;mso-line-height-rule: exactly;background-size: 100% 100%;border-top-left-radius: 5px;" align="right" height="156" valign="bottom" width="252">
            <img alt="" height="156" width="252" src="{image file='assets/img/left.png' source="MeedleContact"}" style="display: block;border: 0;line-height: 100%;width: 100%;">
        </td>
        <td class="Header-icon Target" style="background-color: #11b7f5; background-image: url({image file='assets/img/center.png' source="MeedleContact"}); border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-size: 0;line-height: 0px;mso-line-height-rule: exactly;background-size: 100% 100%; width: 96px !important;" align="center" height="156" valign="bottom">
          <a href="{url path="/"}" target="_blank" style="-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;outline: 0;text-decoration: none;">
         {*   <img alt="" height="156" width="96" src="{image file='assets/img/center.png' source="MeedleContact"}" style="display: block;border: 0;line-height: 100%;"> *}
			  {local_media type="logo"}
			
			<img src="{$MEDIA_URL}" alt="{$company_name}" border="0" style="border: 0px none;border-color: ;border-style: none;border-width: 0px; width: 96px;margin: 0;padding: 0;line-height: 100%;outline: none;text-decoration: none;" width="96" > 
			  
			{/local_media}{*
			<img src="{image file='assets/img/logo.png' source="MeedleContact"}" alt="{$company_name}" border="0" style="border: 0px none;border-color: ;border-style: none;border-width: 0px; width: 96px;margin: 0;padding: 0;line-height: 100%;outline: none;text-decoration: none;" width="96" > 
			  *}{*  background-color: #FFFFFF; *}
          </a>
        </td>
        <td class="Header-right Target" style="background-color: #11b7f5; border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;font-size: 0;line-height: 0px;mso-line-height-rule: exactly;background-size: 100% 100%;border-top-right-radius: 5px;" align="left" height="156" valign="bottom" width="252">
            <img alt="" height="156" width="252" src="{image file='assets/img/right.png' source="MeedleContact"}" style="display: block;border: 0;line-height: 100%;width: 100%;">
        </td>
      </tr>
      </tbody>
    </table>
  </div>
					  {*
  <table class="st-Copy st-Copy--caption st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
    <tbody>
      <tr>
        <td class="Content Title-copy Font Font--title" align="center" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;width: 472px;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #32325d;font-size: 24px;line-height: 32px;">
            <span dir="ltr">{config key="store_name"}</span>
        </td>
      </tr>
      <tr>
        <td class="st-Spacer st-Spacer--stacked" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
          <div class="st-Spacer st-Spacer--filler"> </div>
        </td>
      </tr>
    </tbody>
  </table>
	*}

  <table class="st-Copy st-Copy--caption st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
  <tbody>
    <tr>
      <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
      <td class="st-Font st-Font--caption" style="border: 0; margin: 0; padding: 0; color: #8898aa; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 14px; line-height: 16px;">
		 	{block name="email-content"}{/block}
			{block name='message-body'}{$message_body nofilter}{/block}
		  
		  
		<p>{intl l="Cordialement,"}
       <br>
		{intl l="L'équipe %store_name" store_name={config key="store_name"}} </p>
      </td>
      <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
    <tr>
      <td class="st-Spacer st-Spacer--stacked" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
  </tbody>
</table>

  <table class="st-Divider st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
  <tbody>
    <tr>
      <td class="st-Spacer st-Spacer--divider" colspan="3" height="20" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
    <tr>
      <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;" width="64">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
      <td bgcolor="#e6ebf1" height="1" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
      <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;" width="64">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
    <tr>
      <td class="st-Spacer st-Spacer--divider" colspan="3" height="31" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
  </tbody>
</table>
  <table class="st-Copy st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
  <tbody>
    <tr>
      <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
      <td style="border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; line-height: 24px;">

      {intl l="Si vous avez des questions, contactez-nous à l’adresse"} <a style="border: 0; margin: 0; padding: 0; color: #556cd6 !important; text-decoration: none;" href="mailto:{config key="store_email"}">{config key="store_email"}</a>, {intl l="ou appelez-nous au"} <a style="border: 0; margin: 0; padding: 0; color: #556cd6 !important; text-decoration: none;" href="tel:{config key="store_phone"}">{config key="store_phone"}</a>.

      </td>
      <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;" width="64">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
    <tr>
      <td class="st-Spacer st-Spacer--stacked" colspan="3" height="12" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
  </tbody>
</table>
					  
					  
					  
  <table class="st-Divider st-Width st-Width--mobile" border="0" cellpadding="0" cellspacing="0" width="600" style="min-width: 600px;">
  <tbody>
    <tr>
      <td class="st-Spacer st-Spacer--divider" colspan="3" height="20" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
    <tr>
      <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;" width="64">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
      <td bgcolor="#e6ebf1" height="1" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
      <td class="st-Spacer st-Spacer--gutter" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;" width="64">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
    <tr>
      <td class="st-Spacer st-Spacer--divider" colspan="3" height="31" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;">
        <div class="st-Spacer st-Spacer--filler"> </div>
      </td>
    </tr>
  </tbody>
</table>

<table class="Section Divider Divider--small" width="100%" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;background-color: #ffffff;"><tbody><tr><td class="Spacer Spacer--divider" height="20" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;"> </td></tr></tbody></table>

<table class="Section Copy" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;background-color: #ffffff;">
<tbody>
<tr>
  <td class="Spacer Spacer--gutter" width="64" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;"> </td>
  <td class="Content Footer-legal Font Font--caption Font--mute" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;width: 472px;font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif;mso-line-height-rule: exactly;vertical-align: middle;color: #8898aa;font-size: 12px;line-height: 16px;">
      {intl l="Vous recevez cet e-mail de"} {config key="store_name"}
</td>
</tr>
</tbody>
</table>
<table class="Section Divider Divider--small" width="100%" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;background-color: #ffffff;"><tbody><tr><td class="Spacer Spacer--divider" height="20" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;"> </td></tr></tbody></table>
<table class="Section Section--last Divider Divider--large" width="100%" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;background-color: #ffffff;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;"><tbody><tr><td class="Spacer Spacer--divider" height="64" style="border: 0;border-collapse: collapse;margin: 0;padding: 0;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;color: #ffffff;font-size: 1px;line-height: 1px;mso-line-height-rule: exactly;"> </td></tr></tbody></table>
                  </td>
                </tr>
              </tbody>
            </table>
            <!-- /Wrapper -->

          </td>
        </tr>
        <tr>
          <td class="st-Spacer st-Spacer--emailEnd" height="64" style="border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;">
            <div class="st-Spacer st-Spacer--filler">&nbsp;</div>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- /Background -->

</body></html>