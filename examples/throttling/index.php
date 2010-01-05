<?PHP

include "../index.php";

$shell['title3'] = "Throttling";

$shell['h2'] = 'Get all your JavaScript ducks in a row.';

// ========================================================================== //
// SCRIPT
// ========================================================================== //

ob_start();
?>
$(function(){
  
  // Create a new queue.
  window.queue = $.jqmq({
    
    // Queue items will be processed every 250 milliseconds.
    delay: 250,
    
    // Process queue items one-at-a-time.
    batch: 1,
    
    // For each queue item, execute this function.
    callback: function( item ) {
      $('#output')
        .append( '<span>' + item + '<\/span>' )
        .find('.done')
          .remove();
      
      // Update the "Size" display.
      set_size();
    },
    
    // When the queue completes naturally, execute this function.
    complete: function(){
      $('#output').append( '<span class="done">done<\/span>' );
    }
  });
  
  // On mouseover, add an item to the queue.
  $('#items a').mouseover(function(){
    var item = $(this).text();
    queue.add( item );
    
    // Update the "Last" display.
    set_last( item );
    
    // Update the "Size" display.
    set_size();
  });
  
  // Bind queue actions to nav buttons.
  
  nav( 'Pause', 'Queue paused.', function(){
    queue.pause();
  });
  
  nav( 'Start', 'Queue started.', function(){
    queue.start();
  });
  
  nav( 'Clear', 'Queue cleared.', function(){
    queue.clear();
  });
  
  nav( 'Batch = 1', 'Queue batch size set to 1.', function(){
    queue.update({ batch: 1 });
  });
  
  nav( 'Batch = 4', 'Queue batch size set to 4.', function(){
    queue.update({ batch: 4 });
  });
  
  nav( 'Delay = 100', 'Queue delay set to 100.', function(){
    queue.update({ delay: 100 });
  });
  
  nav( 'Delay = 250', 'Queue delay set to 250.', function(){
    queue.update({ delay: 250 });
  });
  
});
<?
$shell['script'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML HEAD ADDITIONAL
// ========================================================================== //

ob_start();
?>
<script type="text/javascript" src="../../jquery.ba-jqmq.js"></script>
<script type="text/javascript" language="javascript">

// Create a "nav" link for this example.
function nav( title, message, callback ) {
  var n = $('#nav');
  
  if ( n.find('a').length ) {
    n.append(' | ');
  }
  
  $('<a href="#"/>')
    .html( title )
    .appendTo( n )
    .click(function(){
      status( message );
      callback();
      set_size();
      return false;
    });
  
};

// Update the status in this example.
var status_id;
function status( txt ) {
  $('#status').hide().html( txt || '' ).fadeIn( 'fast' );
  
  status_id && clearTimeout( status_id );
  if ( txt ) {
    status_id = setTimeout( function(){ $('#status').fadeOut(); }, 5000 );
  }
};

// Update the queue size in this example.
function set_size(){
  $('#size').text( queue.size() );
};

// Update the last item in this example.
function set_last( item ) {
  $('#last').text( item );
};

<?= $shell['script']; ?>

$(function(){
  
  // Syntax highlighter.
  SyntaxHighlighter.highlight();
  
  // Prevent the default action on these links.
  $('#items a').click(function(){
    return false;
  });
  
});

</script>
<style type="text/css" title="text/css">

/*
bg: #FDEBDC
bg1: #FFD6AF
bg2: #FFAB59
orange: #FF7F00
brown: #913D00
lt. brown: #C4884F
*/

#page {
  width: 700px;
}

#items {
  margin-left: 0;
  padding-left: 0;
}

#items li {
  list-style-type: none !important;
  margin: 0 1px 1px 0;
  text-align: center;
  display: inline;
  line-height: 2em;
}

#items li a {
  color: #000 !important;
  text-decoration: none;
  border: 1px solid #ddd;
  padding: 0.2em 0.4em;
}

#items a:hover {
  border-color: #0a0;
  background: #afa;
}

#status {
  font-style: italic;
  float: right;
}

#nav,
#output {
  margin-bottom: 0.6em;
}

#output {
  border: 1px solid #C4884F;
  background: #FDEBDC;
  padding: 2px 2px 1px;
  min-height: 1.7em;
  width: 694px;
}

#output span,
#key span {
  color: #fff;
  background: #0a0;
  font-weight: 700;
  padding: 0.2em 0.4em;
  margin: 0 1px 1px 0;
}

#output,
#output span {
  float: left;
}

#output .done,
#key .done {
  background-color: #aaa;
}

#key div {
  float: right;
}

</style>
<?
$shell['html_head'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// HTML BODY
// ========================================================================== //

ob_start();
?>
<?= $shell['donate'] ?>

<p>
  With <a href="http://benalman.com/projects/jquery-message-queueing-plugin/">jQuery Message Queuing</a> you can
  throttle a large number of commands or requests, giving each request some breathing room. This can be useful
  for keeping large numbers of costly DOM manipulations from locking up the browser, or for firing off high
  volumes of serial tracking pixel requests.
</p>
<p>
  This example is a purely visual representation of how this type of queue might execute.
</p>

<h3>Let's get to it!</h3>

<p>
  In this example, whenever the queue callback is executed, a green box is added. When the queue becomes empty
  due to its natural completion (and not being explicitly cleared), a grey "done" box is added.
</p>
<p>
  You may hover over any numbered item to add it to the queue, and you may also pause,
  start or clear the queue, as well as change the queue's batch size.
</p>

<ul id="items">
  <li><a href="#01">01</a></li> <li><a href="#02">02</a></li> <li><a href="#03">03</a></li>
  <li><a href="#04">04</a></li> <li><a href="#05">05</a></li> <li><a href="#06">06</a></li>
  <li><a href="#07">07</a></li> <li><a href="#08">08</a></li> <li><a href="#09">09</a></li>
  <li><a href="#10">10</a></li> <li><a href="#11">11</a></li> <li><a href="#12">12</a></li>
  <li><a href="#13">13</a></li> <li><a href="#14">14</a></li> <li><a href="#15">15</a></li>
  <li><a href="#16">16</a></li> <li><a href="#17">17</a></li> <li><a href="#18">18</a></li>
  <li><a href="#19">19</a></li> <li><a href="#20">20</a></li> <li><a href="#21">21</a></li>
  <li><a href="#22">22</a></li> <li><a href="#23">23</a></li> <li><a href="#24">24</a></li>
  <li><a href="#25">25</a></li> <li><a href="#26">26</a></li> <li><a href="#27">27</a></li>
  <li><a href="#28">28</a></li> <li><a href="#29">29</a></li> <li><a href="#30">30</a></li>
  <li><a href="#31">31</a></li> <li><a href="#32">32</a></li> <li><a href="#33">33</a></li>
  <li><a href="#34">34</a></li> <li><a href="#35">35</a></li> <li><a href="#36">36</a></li>
  <li><a href="#37">37</a></li> <li><a href="#38">38</a></li> <li><a href="#39">39</a></li>
  <li><a href="#40">40</a></li> <li><a href="#41">41</a></li> <li><a href="#42">42</a></li>
  <li><a href="#43">43</a></li> <li><a href="#44">44</a></li> <li><a href="#45">45</a></li>
  <li><a href="#46">46</a></li> <li><a href="#47">47</a></li> <li><a href="#48">48</a></li>
  <li><a href="#49">49</a></li> <li><a href="#50">50</a></li> <li><a href="#51">51</a></li>
  <li><a href="#52">52</a></li> <li><a href="#53">53</a></li> <li><a href="#54">54</a></li>
  <li><a href="#55">55</a></li> <li><a href="#56">56</a></li> <li><a href="#57">57</a></li>
  <li><a href="#58">58</a></li> <li><a href="#59">59</a></li> <li><a href="#60">60</a></li>
  <li><a href="#61">61</a></li> <li><a href="#62">62</a></li> <li><a href="#63">63</a></li>
  <li><a href="#64">64</a></li> <li><a href="#65">65</a></li> <li><a href="#66">66</a></li>
  <li><a href="#67">67</a></li> <li><a href="#68">68</a></li> <li><a href="#69">69</a></li>
  <li><a href="#70">70</a></li> <li><a href="#71">71</a></li> <li><a href="#72">72</a></li>
  <li><a href="#73">73</a></li> <li><a href="#74">74</a></li> <li><a href="#75">75</a></li>
  <li><a href="#76">76</a></li> <li><a href="#77">77</a></li> <li><a href="#78">78</a></li>
  <li><a href="#79">79</a></li> <li><a href="#80">80</a></li> <li><a href="#81">81</a></li>
  <li><a href="#82">82</a></li> <li><a href="#83">83</a></li> <li><a href="#84">84</a></li>
  <li><a href="#85">85</a></li> <li><a href="#86">86</a></li> <li><a href="#87">87</a></li>
  <li><a href="#88">88</a></li>
</ul>

<div id="status"></div>
<div id="nav"></div>

<div id="output"></div>

<div id="key">
  Last item: <b id="last">N/A</b>,
  Size: <b id="size">0</b>
  <div>
    <span>item/items processed</span>
    <span class="done">queue completed</span>
  </div>
</div>

<h3 class="clear">The code</h3>

<pre class="brush:js">
<?= htmlspecialchars( $shell['script'] ); ?>
</pre>

<?
$shell['html_body'] = ob_get_contents();
ob_end_clean();

// ========================================================================== //
// DRAW SHELL
// ========================================================================== //

draw_shell();

?>
