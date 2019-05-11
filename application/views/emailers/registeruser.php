<html>
<body>
    <div style="width: 100%;">
        <table style="width:600px;margin: 0 auto;border:1px solid #f1ecec;">
            <tr>
                <th style="border-bottom: 4px solid #ff8849;padding:15px 3px;">
                    <img width="250p" src="http://shreeyantraindia.com/shreeyantra/assets/images/logo.png" alt=""
                        style="float:left;">
                </th>
            </tr>
            <tr>
                <td style="padding:25px 10px;">
                    <h1
                        style="font-family: 'PT Sans', sans-serif;font-size:1.2em;text-transform:capitalize;line-height:1.2em;font-weight: normal;color:#636060;">
                        Dear  <?php echo $data->firstname ." ". $data->lastname; ?> ,</h1>
                    <p style="font-family: 'PT Sans', sans-serif;font-size:1em;line-height:1.4em;color: #928b8b;">We are
                        very excited
                        to have you on board Shree Yantra India.
                        You have registered successfully, please find below deatils to login</p>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="width:500px;margin: 0 auto;border: 1px solid #efe8e8;border-radius:3px;
                        padding:25px 10px;text-align: center;background-color: #fcfcfc;">
                        <h2 style="font-family: 'PT Sans', sans-serif;font-size:1.25em;font-weight: normal;
                            color:#e20000;">
                            Your account information:</h2>
                        <p style="font-family: 'PT Sans', sans-serif;font-size:1em; margin-bottom: 0px;
                            color: #928b8b;">
                            Username : <?php echo $data->username ?> </p>
                        <p style="font-family: 'PT Sans', sans-serif;font-size:1em;margin:6px 0px 30px;
                            color: #928b8b;">
                            Password : <?php echo $data->password ?></p>
                        <a href="https://www.shreeyantraindia.com/login" style="text-decoration:none;">
                            <button style="background-color: #ff8849;color:#fff;border-radius:2px;padding:10px 18px;
                                display:block;margin:0 auto;border:none;font-size: 1em;">
                                Log In Now
                            </button>
                        </a>

                    </div>
                </td>
            </tr>
            <tr>
                <td style="padding:25px 10px;">
                    <p style="font-family: 'PT Sans', sans-serif;font-size:1em;line-height:1.4em;color: #928b8b;">Stay
                        tuned for latest news and updates from the team at Shree Yantra India.</p>
                    <p style="font-family: 'PT Sans', sans-serif;font-size:1em;line-height:1.4em;color: #928b8b;">Thank
                        You,<br>Team Shree Yantra India !</p>
                </td>
            </tr>
            <tr>
                <td>
                    <div style="background-color:  #ff8849;padding:0px 10px">
                        <table>
                            <tr>
                                <td width="500">
                                    <p
                                        style="font-family: 'PT Sans', sans-serif;font-size:0.85em;text-align: left;color: #fff;">
                                        Contact Us:+91 (0) 7744 402345</p>
                                </td>
                                <td width="100">
                                    <ul style="list-style: none;align-items: center;justify-content: center;
                                        display: flex; font-size: 18px; margin: 11px 0px 5px;">
                                        <li style="float:left;padding-right: 5px;"><a
                                                href="https://www.facebook.com/SwarnaShreeYantra">
                                                <img width="25"
                                                    src="https://www.shreeyantraindia.com/shreeyantra/assets/images/fb.png"
                                                    alt="" style="filter: invert(1);"></a>
                                        </li>
                                        <li style="float:left;padding-right: 5px;"><a
                                                href="https://twitter.com/shree_yantra?lang=en">
                                                <img width="25"
                                                    src="https://www.shreeyantraindia.com/shreeyantra/assets/images/twitter.png"
                                                    alt="" style="filter: invert(1);"></a>
                                        </li>
                                        <li style="float:left;padding-right: 5px;"><a
                                                href="https://www.pinterest.com/pin/355573333063811416">
                                                <img width="25"
                                                    src="https://www.shreeyantraindia.com/shreeyantra/assets/images/p-interest.png"
                                                    alt="" style="filter: invert(1);"></a>
                                        </li>
                                        <li style="float:left;"><a
                                                href="https://www.youtube.com/channel/UCq-94wCCoGj-5k1VlRvnteA">
                                                <img width="25"
                                                    src="https://www.shreeyantraindia.com/shreeyantra/assets/images/youtube.png"
                                                    alt="" style="filter: invert(1);">
                                                <!-- <img width="25"
                                                    src="http://shreeyantraindia.com/shreeyantra/assets/images/youtube_img.png"
                                                    alt=""> -->
                                            </a></li>
                                    </ul>
                                </td>
                            </tr>
                        </table>


                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>

</html>