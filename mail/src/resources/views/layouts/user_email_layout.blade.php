<div style="margin:0;padding:0;width:100%;background-color:#f2f4f6" class="gmail_msg">
    <table width="100%" cellpadding="0" cellspacing="0" class="gmail_msg">
        <tbody>
            <tr class="gmail_msg">
                <td style="width:100%;margin:0;padding:0;background-color:#f2f4f6" align="center" class="gmail_msg">
                    <table width="100%" cellpadding="0" cellspacing="0" class="gmail_msg">
                        <tbody>
                            <tr class="gmail_msg">
                                <td style="padding:25px 0;text-align:center" class="gmail_msg">
                                    <a  style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;font-size:16px;font-weight:bold;color:#2f3133;text-decoration:none" 
                                        href="{{ env('APP_URL') }}" class="gmail_msg" target="_blank" >
                                            {{ Config::get('app.name') }}
                                    </a>
                                </td>
                            </tr>

                            <tr class="gmail_msg">
                                <td style="width:100%;margin:0;padding:0;border-top:1px solid #edeff2;border-bottom:1px solid #edeff2;background-color:#fff" 
                                width="100%" class="gmail_msg">
                                    <table style="width:auto;max-width:570px;margin:0 auto;padding:0" 
                                        align="center" width="570" 
                                        cellpadding="0" cellspacing="0" class="gmail_msg">
                                        <tbody><tr class="gmail_msg">
                                            <td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;padding:35px" class="gmail_msg">
                                                
                                                <h1 
                                                	style="margin-top:0;color:#2f3133;font-size:19px;font-weight:bold;text-align:left"
                                                	class="gmail_msg"> 
                                                		Hello!  
                                                        

                                                </h1>

                                                <p style="margin-top:0;color:#74787e;font-size:16px;line-height:1.5em" class="gmail_msg">
                                                    @yield('mail_content')
                                                    <br>
                                                    <br>
                                                    Regards,<br class="gmail_msg">{{ Config::get('app.name') }}
                                                </p>

                                                
                                             </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>

                            <tr class="gmail_msg">
                                <td class="gmail_msg">
                                    <table style="width:auto;max-width:570px;margin:0 auto;padding:0;text-align:center" align="center" width="570" cellpadding="0" cellspacing="0" class="gmail_msg">
                                        <tbody><tr class="gmail_msg">
                                            <td style="font-family:Arial,'Helvetica Neue',Helvetica,sans-serif;color:#aeaeae;padding:35px;text-align:center" class="gmail_msg">
                                                <p style="margin-top:0;color:#74787e;font-size:12px;line-height:1.5em" class="gmail_msg">
                                                    © 2016
                                                    <a style="color:#3869d4" href="{{ env('APP_URL') }}" class="gmail_msg" target="_blank" >
                                                            {{ Config::get('app.name') }}
                                                    </a>.
                                                    All rights reserved.
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody></table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>