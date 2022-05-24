jQuery(document).ready(function ($) {  
    // Anzahl activate
    $('input[name="format[]"]:eq(0)').on('change', function() {
        $('.anzahl').toggleClass('active');
        $('#anzahl').val('');
    });
    // file name
    $("#file-upload").change(function() {
        filename = this.files[0].name;
        $('#file-name').text(filename);
    });
    // formular format
    $('.format input:eq(3)').attr('disabled','disabled');
    $('input[name="services[]"]').on('change', function() {
        $('.format input').parent().removeClass('enabled');
        $('.format input').prop('checked', false);
        let n = 0;
        let i = 0;
        $('input[name="services[]"]:checked').each(function(){
            if($(this).val()==='Amtliche Vermessung'||$(this).val()==='Kantonsstrassenentwässerung'){
                $('.format input').parent().removeClass('enabled');
                $('.format input').prop('checked', false);
                //$('.format input:eq(2)').attr('disabled','disabled');
                n++;
            }
            if($(this).val()==='Wasser'||$(this).val()==='Abwasser'){
                i++;
            }
        });
        if(n===0){
            $('.format input').parent().removeClass('enabled');
            $('.format input').prop('checked', false);
            $('.format input').removeAttr('disabled');
        }
        if(i>0){
            $('.format input:eq(3)').removeAttr('disabled');
        }else{
            $('.format input:eq(3)').attr('disabled','disabled');
        }
    });
    // formular enable checkboxes
    $('.services input').parent().attr('disabled','disabled');
    $('.locations select').on('change', function() {
        $('.format input').parent().removeClass('enabled');
        $('.format input').prop('checked', false);
        $('.format input').removeAttr('disabled');
        $('.services input').parent().removeClass('enabled');
        $('.services input').prop('checked', false);
        $('.services input').attr('disabled','disabled');
        let location = this.value;
        //--x-x
        if(location==='Aesch'||location==='Flühli'||location==='Hitzkirch – Mosen'){
            $('.services input:eq(2), .services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(2), .services input:eq(4)').parent().addClass('enabled');
        //xxx-x
        }else if(location==='Beromünster'||location==='Beromünster – Gunzwil'||location==='Beromünster – Schwarzenbach'||location==='Eich'||location==='Geuensee'||location==='Mauensee'||location==='Schlierbach'||location==='Triengen – Kulmerau'||location==='Triengen – Wilihof'){
            $('.services input:eq(0), .services input:eq(1), .services input:eq(2), .services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(0), .services input:eq(1), .services input:eq(2), .services input:eq(4)').parent().addClass('enabled');
        //xx--x
        }else if(location==='Beromünster – Neudorf'||location==='Schenkon'||location==='Sempach'||location==='Triengen – Winikon'){
            $('.services input:eq(0), .services input:eq(1), .services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(0), .services input:eq(1), .services input:eq(4)').parent().addClass('enabled');
        //x---x
        }else if(location==='Büron'||location==='Buttisholz'||location==='Grosswangen'||location==='Hildisrieden'||location==='Neuenkirch'||location==='Rickenbach'||location==='Rickenbach – Pfeffikon'){
            $('.services input:eq(0), .services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(0), .services input:eq(4)').parent().addClass('enabled');
        //x-x-x
        }else if(location==='Knutwil'){
            $('.services input:eq(0), .services input:eq(2), .services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(0), .services input:eq(2), .services input:eq(4)').parent().addClass('enabled');
        //-x--x
        }else if(location==='Nebikon'||location==='Roggliswil'||location==='Wauwil'||location==='Wikon'){
            $('.services input:eq(1), .services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(1), .services input:eq(4)').parent().addClass('enabled');
        //-x---
        }else if(location==='Wiliberg (AG)'){
            $('.services input:eq(1)').removeAttr('disabled');
            $('.services input:eq(1)').parent().addClass('enabled');
        //xxxxx
        }else if(location==='Oberkirch'||location==='Sursee'||location==='Triengen'){
            $('.services input:eq(0), .services input:eq(1), .services input:eq(2), .services input:eq(3), .services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(0), .services input:eq(1), .services input:eq(2), .services input:eq(3), .services input:eq(4)').parent().addClass('enabled');
        //xx-xx
        }else if(location==='Nottwil'){
            $('.services input:eq(0), .services input:eq(1), .services input:eq(3), .services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(0), .services input:eq(1), .services input:eq(3), .services input:eq(4)').parent().addClass('enabled');
        }
        else{
            $('.services input:eq(4)').removeAttr('disabled');
            $('.services input:eq(4)').parent().addClass('enabled');
        }
    });
    // add active mega menu class
    $('.mega-link a').each(function(){
        let link = $(this).attr('href');
        let newURL = window.location.protocol + "//" + window.location.host + window.location.pathname + window.location.search;
        if(link===newURL.slice(0,-1)){
        jQuery(this).addClass('active');
        }
    });
    // Scroll left
    $('html, body').scrollLeft(0);
    // Mobile submenu
    $('#mobile-menu .menu-item-has-children a:eq(0)').click(function(){
        $(this).parent().toggleClass('open');
        $(this).parent().find('.sub-menu').slideToggle(250);
        return false;
    });
    // Submenu
    $('#menu-header-menu-1 .menu-item-has-children').hover(function () {
        $(this).find('a:first').toggleClass('hover');
    });
    // Selectric
    if ( $.isFunction($.fn.selectric) ) {
        $('select').selectric({
            onChange: function() {
                $('#filter-time').submit();
            }
        });
    }
    // Search toggle
    $('.search-toggle').click(function () {
        $(this).parent().find('.search-field').focus().addClass('open');
        $(this).hide();
    });
    // Menu toggle
    $('#menu-toggle').click(function () {
        $('#menu-toggle,#nav-icon,#mobile-menu,html').toggleClass('open');
    });
    // Gallery slider
    if ($().slick) {
        var gallery_rows = $('.gallery-row').length;
        if(gallery_rows>1){
            $('#gallery-images').slick({
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                prevArrow: $('#slide-left'),
                nextArrow: $('#slide-right'),
                responsive: [
                    {
                        breakpoint: 640,
                        settings: {
                            slidesToShow: 1,
                            adaptiveHeight: true
                        }
                    }
                ]
            });
        }
    }
    // Clear search
    $('.clear-search').click(function () {
        $(this).parent().find('.search-field').val('');
    });
    // Megamenu
    let megamenu = $('#megamenu').html();
    $('#megamenu').remove();
    $('#menu-header-menu-1 .mega').append('<div id="megamenu">' + megamenu + '</div>');
    $('#menu-header-menu-1 .mega').mouseenter(function () {
        $(this).find('a:first').addClass('hover');
        $('#megamenu, .megaoverlay').fadeIn(50);
    });
    $('#menu-header-menu-1 .mega').mouseleave(function () {
        $(this).find('a:first').removeClass('hover');
        $('#megamenu, .megaoverlay').hide();
    });
    // Mobile megamenu
    $('#menu-header-menu .mega').append('<div id="megamenu-mobile">' + megamenu + '</div>');
    $('#menu-header-menu .mega a:eq(0)').click(function(){
        $(this).toggleClass('open');
        $('#megamenu-mobile').slideToggle();
        return false;
    });
    $('#menu-header-menu h3').click(function () {
        $('.mega-link').hide();
        $(this).parent().find('.mega-link').show();
    });
    
    // Expand toggle
    $('.expanding-row').click(function () {
        $(this).toggleClass('open');
        $(this).find('.expanding-text').slideToggle(200);
    });
    // Filter projects by tags
    $('#filter').submit(function(){
        var filter = $('#filter');
        $.ajax({
            url:filter.attr('action'),
            data:filter.serialize(), // form data
            type:filter.attr('method'), // POST
            beforeSend:function(xhr){
                filter.find('button').text('Processing...'); // changing the button label
            },
            success:function(data){
                filter.find('button').text('Apply filter'); // changing the button label back
                $('#all-projects').html(data); // insert data
            }
        });
        return false;
    });
    $('.projects-page .post_tags a').click(function(){
        $('#content .post_tags a').removeClass('active');
        $(this).addClass('active');
        let tag_name = $(this).text();
        $('#filter select option').each(function(){
            if($(this).text()===tag_name){
                let selected_value = $(this).attr('value');
                $('#filter select').val(selected_value);
                $('#filter').submit();
            }
        });
        return false;
    });
    // Filter blogs by time
    $('#filter-time').submit(function(){
        var filter = $('#filter-time');
        $.ajax({
            url:filter.attr('action'),
            data:filter.serialize(), // form data
            type:filter.attr('method'), // POST
            beforeSend:function(xhr){
                filter.find('button').text('Processing...'); // changing the button label
            },
            success:function(data){
                filter.find('button').text('Apply filter'); // changing the button label back
                $('#all-posts').html(data); // insert data
            }
        });
        return false;
    });
    // Filter blogs by category
    $('.page-blog .all_tags a').click(function(){
        $('#content .all_tags a').removeClass('active');
        $(this).addClass('active');
        let tag_name = $(this).text();
        $('#blog-cat').val(tag_name);
        $('#filter-time').submit();
        return false;
    });
    // Filter members
    $('#filter-members').submit(function(){
        var filter = $('#filter-members');
        $.ajax({
            url:filter.attr('action'),
            data:filter.serialize(), // form data
            type:filter.attr('method'), // POST
            beforeSend:function(xhr){
                filter.find('button').text('Processing...'); // changing the button label
            },
            success:function(data){
                filter.find('button').text('Apply filter'); // changing the button label back
                $('#members').html(data); // insert data
            }
        });
        return false;
    });
    $('#filter-members input[type=checkbox]').change(function() {
        $('#filter-members').submit();
    });
    // get
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;
    
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
    
            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };
    if($('#content').hasClass('page-team')){
        let department = getUrlParameter('department');
        if(department  !== undefined){
            $("#filter-departments input[value="+department+"]")[0].click();
        }
        let company = getUrlParameter('company');
        if(company  !== undefined){
            $("#filter-companies input[value="+company+"]")[0].click();
        }
        let position = getUrlParameter('position');
        if(position  !== undefined){
        $("#filter-positions input[value="+position+"]")[0].click();
        }
    }
});