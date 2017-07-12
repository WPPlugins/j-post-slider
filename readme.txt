=== Plugin Name ===
Contributors: Ivan Djurdjevac
Tags: jquery, ajax, slider, animation, slide show
Requires at least: 2.5
Tested up to: 2.6.2
Stable tag: 1.3.1

== Description ==

Show your post in fancy jQuery box, rotating images, with show-up text box with post description. Mousover stop the animation, and user can click on post link anytime ;)I used Boban Karisik <a href="http://www.serie3.info/s3slider/index.php" target="_blank">s3Slider jQuery</a> scipt. Thanks Boban for nice jQuery script. I can't show you how much cool is this plugin, you just need to try it.

This plugin will rotate latest posts from blog, presented with selected image, post headline, and optional post excerpt. One post can have one J Post Slider, image for this animation.

You can set up:

   1. How many latest post to rotate
   2. Post offset, if you don’t want to show latest post in J Post Slider Box
   3. Images Width and Height for animation box. NOTE: every image you pick for J Post Slider plugin need to have same sizes, to make this animation look smootly
   4. Animation speed
   5. To show or not post excerpt
   6. Headline and excerpt can show up from top, left, bottom or right. Plugin can show up text area top and bottom, or left and right reciprocally or it can show area randomly
   7. Text area opacity
   8. Select categories from which this plugin can rotate post.

== Installation ==

   1. Unzip JPostSlider archive zip file, and upload folder JPostSlider into wp-content/plugins/ folder
   2. Activate J Post Slider Wordpress plugin
   3. Go into Settings -> J Post Slider, and customize options for your need
   4. Now at the Writing post panel, you can find Select Image for J Post Slider Plugin Animation Box ;) where you can select image for J Post animation. You can pick only image which is uploaded into post gallery when you editing post. When you write new post you can pick from 10 latest images.
   5.
      <code><?
      if (function_exists("js_show_images")) {
          js_show_images();
      }
      ?></code>

      Add this code into your template file outside of loop, where you want to put this animation box. 

== Further Information ==

This Plugin will present your HOT posts, in jQuery animation show. You just make sure that every image, you pick have same sizes. Plugin will give notice if you pick image with wrong size. I used Scriptaculous, web 2.0 javascript to call php function to load images, without loading whole page.

If you have some idea how to improve this plugin, i would like to hear it, and also i want to see your comments how do you like it or not like it. If you want you can send me a link with this plugin in action, and i will publish it here so people can see it.

More information, the latest updates can found at the http://www.prodeveloper.org/j-post-slider-wordpress-plugin-jquery-post-animation-show.html