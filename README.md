# Front End Cheat Sheet

A collection of frequently used front end code snippets by [Roni "Rolle" Laukkarinen](http://www.twitter.com/rolle). Used [CodeBox](http://www.shpakovski.com/codebox/) for a long time, but noticed it was overkill for simple snippets. So, back to basics.

## jQuery

### Slide based on viewport height

    $('.slide').css('height', window.innerHeight);
    $(window).resize(function(){
        $('.slide').css('height', window.innerHeight);
    });