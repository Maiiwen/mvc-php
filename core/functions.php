<?php
function BBCode($text)
{
  // NOTE : I had to update this sample code with below line to prevent obvious attacks as pointed out by many users.
  // Always ensure that user inputs are scanned and filtered properly.
  $text  = htmlspecialchars($text, ENT_QUOTES);

  // BBcode array
  $find = array(
    '~\[hr\]~s',
    '~\[br\]~s',
    '~\:angel\:~s',
    '~\:angry\:~s',
    '~8-\)~s',
    "~:'\(~s",
    '~\:ermm\:~s',
    '~\:D~s',
    '~\<3~s',
    '~\:\(~s',
    '~\:\O~s',
    '~\:\P~s',
    '~\;\)~s',
    '~\:alien\:~s',
    '~\:blink\:~s',
    '~\:blush\:~s',
    '~\:cheerful\:~s',
    '~\:devil\:~s',
    '~\:dizzy\:~s',
    '~\:getlost\:~s',
    '~\:happy\:~s',
    '~\:kissing\:~s',
    '~\:ninja\:~s',
    '~\[b\](.*?)\[/b\]~s',
    '~\[code\](.*?)\[/code\]~s',
    '~\[i\](.*?)\[/i\]~s',
    '~\[u\](.*?)\[/u\]~s',
    '~\[size=(.*?)\](.*?)\[/size\]~s',
    '~\[color=(.*?)\](.*?)\[/color\]~s',
    '~\[url=(.*?)\](.*?)\[/url\]~s',
    '~\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s',
    '~\[center\](.*?)\[/center\]~s',
    '~\[left\](.*?)\[/left\]~s',
    '~\[right\](.*?)\[/right\]~s',
    '~\[justify\](.*?)\[/justify\]~s',
    '~\[ul\](.*?)\[/ul\]~s',
    '~\[ol\](.*?)\[/ol\]~s',
    '~\[li\](.*?)\[/li\]~s',
    '~\[quote\](.*?)\[/quote\]~s',
  );

  // HTML tags to replace BBcode
  $replace = array(
    '<hr>',
    '<br>',
    '<i class="em em-innocent"></i>',
    '<i class="em em-angry"></i>',
    '<i class="em em-sunglasses"></i>',
    '<i class="em em-confounded"></i>',
    '<i class="em em-neutral_face"></i>',
    '<i class="em em-smile"></i>',
    '<i class="em em-heart"></i>',
    '<i class="em em-anguished"></i>',
    '<i class="em em-open_mouth"></i>',
    '<i class="em em-stuck_out_tongue"></i>',
    '<i class="em em-wink"></i>',
    '<i class="em em-alien"></i>',
    '<i class="em em-blush"></i>',
    '<i class="em em-flushed"></i>',
    '<i class="em em-stuck_out_tongue_winking_eye"></i>',
    '<i class="em em-smiling_imp"></i>',
    '<i class="em em-confounded "></i>',
    '<i class="em em-unamused "></i>',
    '<i class="em em-relieved "></i>',
    '<i class="em em-kissing_heart "></i>',
    '<i class="em em-see_no_evil"></i>',
    '<b>$1</b>',
    '<pre><code>$1</code></pre>',
    '<i>$1</i>',
    '<span style="text-decoration:underline;">$1</span>',
    '<span class="fs-$1">$2</span>',
    '<span style="color:$1;">$2</span>',
    '<a href="$1">$2</a>',
    '<img src="$1" alt="" />',
    '<div class="text-center">$1</div>',
    '<div class="text-start">$1</div>',
    '<div class="text-end">$1</div>',
    '<div style="text-align: justify;">$1</div>',
    '<ul>$1</ul>',
    '<ol>$1</ol>',
    '<li>$1</li>',
    '<figure class="mb-0">
        <blockquote class="blockquote">
          <p class="pb-3">
            <i class="fas fa-quote-left fa-xs text-secondary"></i>
            <span class="lead font-italic">$1</span>
            <i class="fas fa-quote-right fa-xs text-secondary"></i>
          </p>
        </blockquote>
      </figure>',
  );

  // Replacing the BBcodes with corresponding HTML tags
  $text = preg_replace($find, $replace, $text);
  return $text;
}
