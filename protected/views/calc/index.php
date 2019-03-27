<? Yii::app()->user->setState('save', null); ?>

<div class="calculator">
    
    <!-- <div style = "width:100%; display:block;">
        <img style = "width:20px; height:20px; "class="primary-menu__item-icon" src="/my/a5f687ad4298742b605ad519c91402b2.png"> <a href = "/" style = "margin-left:5px;">Acceuil</a> / Chiffrage immédiat
    </div> -->
    <section id="calc">
      <nav class="top clearfix">
        <div class="front-right">
          <a href="">вход | регистрация</a>
        </div>
      </nav>
       <div class="section-title">
        <div class="bg"><p>калькулятор</p></div>
        <p class="actual"><span class="underline">кальк</span>улятор</p>
      </div>

    </section>
       <div class="widget widget-faq" style = "    width: 100%;">
           <h2 class="h2-one" id = "get_val">Chiffrage immédiat <span class="span-before">?</span></h2>
           <div class="calculator__directions">
               <div class="row">
               <? foreach ($model as $value) { ?>
                  
                   <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 img-holder" style="text-align: center; "> 
                   <? $img = json_decode($value->image_image, true); ?>
                   <a  href="" data-id = "<?=$value->id?>" data-nextid = ""  class="calc-click calculator__directions__item" role="presentation">
                   <span class="img-cont">
                   
                       <img  class="center-block img-responsive" width = "100%" src="http://admin.devis-travaux-online.fr/upload/Calc/tm/<?=$img[0]?>">
                  
                   <span class = "asd"><?=$value->name_text?></span>
                   </span class="img-cont">
                       <button class="calculator__info-btn dark" data-toggle="popover" data-trigger="focus" data-placement="bottom" title="" data-in-anchor="true" data-content="<?=strip_tags($value->info_bigtexteditor)?>" data-original-title="<?=$value->name_text?>">
                           <? if ($value->info_bigtexteditor != null) { ?>
                               <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                           <? } ?>
                       </button>
                   </a>
                   </div>

               <? } ?>
           </div>
           </div>
           <? if ($_SESSION['calc'] == "good") { $_SESSION['calc'] = null; ?>
        <div class="dm-overlay" id="push_error" style="display: block; z-index:99993;">
           <div class="dm-table">
               <div class="dm-cell">
                   <div class="dm-modal">
                       <div id = "mymodal"><div class="fancybox-error" style="border:1px solid;"><h3 class="control-label">Le pre-chiffrage vous est envoye</h3>
                                   <div data-id="498" class="pclose btn btn-success" style="padding: 10px 20px; text-transform: uppercase;">Valide</div></div></div>
                   </div>
               </div>
           </div>
       </div>
           <? } ?>

           <div class="wrap-calc">
               <div id = "calc_results"></div>
               <div id = "calc_body" class="calculator__body" style = "display:none;"></div>
               <div id = "calc_smetaaa"></div>
           </div>
       </div>
</div>



<script>
    var cs = [];
    var garr = [];
    var garr1 = [];
    var garr2 = [];
    var charr = [];
    var mya = [];
    var active = 0;
    var sum = [];
    var por = -1;
    $('body').on("click", ".calc-click", function () {
        $(".calc-click").each(function() {
            $(this).removeClass("actcalc");
        });
        $(this).addClass("actcalc");
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/site/calc/",
            data: {id:id},
            success: function(data) {
                $("#get_val").attr("data-t1", ""+ $(".asd").html() +"");
                $("#calc_results").html("<h2 class='above-calc' id = \"get_val\">выберите <br> категории <span class=\"span-before\">?</span></h2>" + data);
                $("#calc_body").empty();
                $("#calc_body").show();
                $('.calccategory').first().trigger('click');
            },
        });
        Nulled();
        $("#calcitem").show();
        //garr = [];
        cs = [];
        charr = [];
        $('html,body').animate({scrollTop: $("#calc_results").offset().top}, 'slow');
        return false;
    });

    $('body').on("click", ".calccategory", function () {
        var id = $(this).data("id");

        GetBody(id);
        $("#calcitem").show();
        Nulled();
        //garr = [];
        cs = [];
        charr = [];
    });

    function GetBody(id) {
        $.ajax({
            type: "POST",
            url: "/site/calcbody/",
            data: {id:id},
            success: function(data) {
                $("#calc_body").html(data);
                $("#get_val").attr("data-t2", ""+ $("#one").html() +"");


                if(window.innerWidth <= 1000) {
                    let select = document.createElement('select');
                    let keys = [];
                    let buttons = [];
                    $('#calc_body').find("thead th > span").each((i, el) => {
                        console.log(i, el.innerText)
                        keys[i] = el.innerText
                        let option = document.createElement('option');
                        option.value = el.innerText;
                        option.innerHTML = el.innerText;
                        option['data-id'] = i;
                        select.append(option);
                    }) 

                    $('#calc_body').find(".item-click").each((i, el) => {
                        buttons[i] = el;
                    })

                    $select = $(select);
                    $select.prop('id', 'my_cat_select');
                    $select.on('change', function(e) {
                        let $selected = $("option:selected", this);
                        let id = +$selected.prop('data-id');
                        buttons[id].click();
                    });

                    $('#calc_body .row').prepend(select);
                    buttons[0].click()
                }
            },
        });
        Nulled();
        $("#calcitem").show();

        //garr = [];
        cs = [];
        charr = [];
        return false;
    }
    $('body').on("click", ".item-click", function () {
        $(".item-click").each(function() {
            $(this).removeClass("actitem");
        });
        $(this).addClass("actitem");
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/site/calcitem/",
            data: {id:id},
            success: function(data) {
                $("#calcitem").html(data);
                $("#get_val").attr("data-t3", ""+ $("#two").html() +"");
            },
        });
        Nulled();
        $("#calcitem").show();
        ///garr = [];
        cs = [];
        charr = [];
        return false;
    });

    $('body').on("click", ".resultat", function () {
        var my_arr = [];
        $(".my").each(function () {
            if($(this).is(":visible")) {
                var type = $(this).data("type");
                if (type == "choix") {
                    //Zapis("choix", $(this).find(".control-label").text(), $(this).find(".sele").find(":selected").val(), $(this).find(".sele").find(":selected").data("price"), $(this).find(".sele").find(":selected").data("finish"));
                    my_arr.push("choix|"+ $(this).find(".control-label").text() +"|"+$(this).find(".sele").find(":selected").val()+"|"+$(this).find(".sele").find(":selected").data("price")+"|"+$(this).find(".sele").data("finish") + "|null" + "|" + $(this).data("vid"));
                    //alert($(this).find(".sele").find(":selected").text());
                } else if (type == "product") {
                    my_arr.push("product|" + $(this).find(".choise").data("title") + "|" + $(this).data("postfix")+"|null|"+$(this).data("finish") + "|" + $(this).find(".choise").data("price") + "|" + $(this).data("vid"));
                } else if (type == "checkbox_list") {
                    var acs = null;
                    /*mya.forEach(function(item, i, cs) {
                        if (acs == null) {
                            acs = item;
                        } else {
                            acs = acs + ":" + item;
                        }
                    });*/
                    console.log(sum[$(this).data("vid")]);
                    my_arr.push("checkbox_list|" + sum[$(this).data("vid")] + "|" + $(this).data("finish") + "|" + $(this).data("vid"));
                } else if (type == "multiplier") {
                    //Zapis("multiplier", null, $(this).data("postfix"), $(this).find(".cinput").val(), $(this).data("finish"));
                    my_arr.push("multiplier|null|"+ $(this).data("postfix")+"|"+$(this).find(".cinput").val()+"|"+$(this).data("finish")+"|null" + "|" + $(this).data("vid"));
                } else if (type == "square") {
                    //Zapis("square", null, $(this).data("postfix"), $(this).find(".cinput").val(), $(this).data("finish"));
                    my_arr.push("square|null|"+ $(this).data("postfix")+"|"+$(this).find(".cinput").val()+"|"+$(this).data("finish")+"|null" + "|" + $(this).data("vid"));
                } else if (type == "counter") {
                    //Zapis("counter", null, $(this).data("postfix"), $(this).find(".cinput").val(), $(this).data("finish"), $(this).data("price"));
                    my_arr.push("counter|null|" + $(this).data("postfix") + "|" + $(this).find(".cinput").val() + "|" + $(this).data("finish") + "|" + $(this).data("price") + "|" + $(this).data("vid"));
                }
            }
        });
        $.ajax({
            type: "POST",
            url: "/site/calcresults/",
            data: {my_arr:my_arr},
            success: function(data) {
                $("#calc_smetaaa").html(data);
                $(".vt1").html($("#get_val").data("t2"));
                $(".vt2").html($("#get_val").data("t3"));
                $(".cat1").html($("#get_val").data("t1"));
                active = 0;
                var re = /\[\d{1,}\]/ig;
                var str = data;
   
                var result = str.match(re);
                var i = 0;

                setTimeout(function() {
                    var i = 1;
                    $(".numbr").each(function () {
                        i++;
                    });

                    var total = 0;
                    var proc = 0;
                    var total_o = 0;
                    $(".rudik_total").each(function() {
                        total = Number(total) + Number($(this).text());
                    });
                    proc = Number(total)*10/100;
                    $(".rudik_o_proc").html(parseFloat(proc).toFixed(2) + " €");
                    $(".rudik_o_total").html(total);
                    var t_t = 0;
                    t_t = total + proc;
                    $(".rudik_o_result").html(parseFloat(t_t).toFixed(2));
                    
                }, 500);
                $("#calcitem").hide();

                cs = [];
            },
        });
        //$("#calcitem").empty();
        Nulled();
        return false;
    });

    function Set(id, data, newstr) {
        /*  var pattern = '\\['+ id +'\\]';
            //var text = $('#vid_' + id).data("mes");
            var text = garr[id];

            pattern = new RegExp(pattern);
            newstr = newstr.replace(pattern, text);
            $("#calcresults").html(newstr); */
    }

    function Zapis(type, label, text, price, finish, dopprice) {
        $.ajax({
            type: "POST",
            url: "/site/zapis/",
            data: {type:type, label:label, text:text, price:price, finish:finish, dopprice:dopprice},
            success: function(data) {

            },
        });
    }


    var arr = [];
    $("body").on("change", ".sele", function () {
        var mestext = $("option:selected", this).data("messagetext");
        var select_id = $(this).data("cid");
        var option_id = $("option:selected", this).data("id");
        var session = Math.round(getRandomArbitary(1, 1000));

        $.ajax({
            type: "POST",
            url: "/site/element/",
            data: {id:select_id, option_id:option_id, session:session},
            success: function(data) {
                console.log(data);
            },
        });

        if ($(this).data("action") != null && $(this).data("action") != "") {
            var next = $(this).data("action");
            //alert(next);
            var action = $(this).data("ac");
        } else {
            var next = $("option:selected", this).data("action");
            //dalert("test:" + next);
            var action = $(this).data("ac");
        }


        $(this).attr("data-mes", mestext);
        garr[$(this).data("cid")] = $("option:selected", this).data("messagetext");

        $(this).attr("data-ch", $("option:selected", this).val());

        for (var i = action+1; i < 100; i++) {
            if ($('.act_' + i).length) {
                if($('.act_' + i).is(":visible")) {
                    $(".act_" + i).hide();
                }
            }
            $('.sel_' + i + ' option:eq(0)').prop('selected', true);

        }

        OffButton();
        if ($("#id_" + next).length) {
            $("#id_" + next).show();
        } else {
            OnButton();
        }
    });
    $("body").on("change", ".cinput", function () {
        var next = $(this).data("action");
        if ($(this).val() != "") {
            if ($("#id_" + next).length) {
                $("#id_" + next).show();
            } else {
                OnButton();
            }
        } else {
            $("#id_" + next).hide();
            OffButton();
        }
    });
    function Nulled() {
        active = 0;
        $("#calculator__results").empty();
    }
    var prodselect = 0;
    $("body").on("click", ".prod-go", function () {
        var id = $(this).data("id");
        prodselect = $(this).data("id");
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "/site/calcproducts/",
                data:{id:id},
                success: function(data) {
                    $(".fancybox-error").html(data);
                    $(".fancybox-error").attr('style', 'max-width: 90% !important');
                },
            });

        }, 100);
    });

    var checkbox_next = 0;
    $("body").on("click", ".checkbox-go", function () {
        var id = $(this).data("id");
        checkbox_next = $(this).data("action");
        OffButton();
        setTimeout(function () {
            $.ajax({
                type: "POST",
                url: "/site/calccheckbox/",
                data:{id:id},
                success: function(data) {
                    $(".dm-overlay").show();
                    $("#mymodal").html(data);
                    //$(".fancybox-error").attr('style', 'border:1px solid;');
                },
            });

        }, 100);
    });

    $('body').on('click', '.valide', function() {
        var aid = $(this).data("id");
        var session = Math.round(getRandomArbitary(1, 1000));
        $('input[type=checkbox]').each(function(){
            if ($(this).is(":checked")) {
                var select_id = aid;
                var option_id = $(this).data("id");
                $.ajax({
                    type: "POST",
                    url: "/site/element/",
                    data: {id:select_id, option_id:option_id, session:session},
                    success: function(data) {
                        console.log(data);
                        if ($("#id_" + checkbox_next).length) {
                            $("#id_" + checkbox_next).show();
                        } else {
                            OnButton();
                        }
                        $(".dm-overlay").hide();
                    },
                });
            }
        });


      /*  if (cs != null) {
            if ($("#id_" + checkbox_next).length) {
                $("#id_" + checkbox_next).show();
            } else {
                OnButton();
            }
            $(".dm-overlay").hide();
            //$(".fancybox-container").hide();
            //$(".fancybox-enabled").removeAttr('class');
        }
        //$(".fancybox-container").remove();
        console.log(garr);*/
    });


    function OnButton() {
        $('.resultat').removeAttr("disabled");
    }
    function OffButton() {
        $('.resultat').attr("disabled", 'disabled');
    }

    function ProdChoise(title, price, id) {
        var session = Math.round(getRandomArbitary(1, 1000));
        var next = $(".prods").not(':hidden').last().data("action");
        $(".choise").not(':hidden').last().html("Produit selectionne: " + title);
        $(".choise").not(':hidden').last().attr("data-title", title);
        $(".choise").not(':hidden').last().attr("data-price", price);
        console.log(prodselect + " - " + id);
        $.ajax({
            type: "POST",
            url: "/site/prods/",
            data: {prodselect:prodselect, id:id, session:session},
            success: function(data) {
                console.log(data);
            },
        });
        $.ajax({
            type: "POST",
            url: "/site/element/",
            data: {id:prodselect, option_id:id, session:session, type:"prod"},
            success: function(data) {
                console.log(data);
            },
        });


        if ($("#id_" + next).length) {
            $("#id_" + next).show();
        } else {
            OnButton();
            $(".fancybox-enabled").removeAttr('class');
        }
        console.log(garr);
    }


    $("body").on("click", ".remove-all", function () {
        $("#calc_smetaaa").empty();
        $.ajax({
            type: "GET",
            url: "/site/alldelete/",
            success: function(data) {
            },
        });
        return false;
    });
    $("body").on("click", ".remove", function () {
        var cl = $(this).data('id');
        console.log(cl, $('[data-id='+cl+']'));
        if ($('[data-id='+cl+']').length < 2) {
            $("#" + cl).parent().remove();
        }
        $(this).parent().parent().parent().parent().remove();
        var i = 1;
        $(".numbr").each(function () {
            i++;
        });

        var total = 0;
        var proc = 0;
        var total_o = 0;
        $(".rudik_total").each(function() {
            total = Number(total) + Number($(this).text());
        });
        proc = Number(total)*10/100;
        $(".rudik_o_total").html(total);
        $(".rudik_o_proc").html(proc);
        $(".rudik_o_result").html(Number(total) + Number(proc));

        $.ajax({
            type: "POST",
            url: "/site/delete/",
            data:{id:cl},
            success: function(data) {
            },
        });
        return false;
    });

    function SetMessage() {
        $(".calculator__results__message").each(function() {
            $(this).find('span').each(function() {
                $(this).html($("#vid_"+ $(this).attr("id") +" option:selected").val());
            });
        });
    }

    $("body").on("click", ".c_save", function () {
        var smeta = $("#pdf").html();
        $.ajax({
            type: "POST",
            url: "/site/gopdf/",
            data:{smeta:smeta},
            success: function(data) {
                $(location).attr('href','/pdf.php');
            },
        });
        return false;
    });

    $('body').on('click', '.fancybox-close-small', function () {
        $(".fancybox-container").remove();
    });

    function getRandomArbitary(min, max)
    {
        return Math.random() * (max - min) + min;
    }
    
    $("body").off("click", ".prod-info");
    $("body").on("click", ".prod-info", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "/site/prodinfo/",
            data:{id:id},
            success: function(data) {
                $(".dm-overlay").show();
                $("#mymodal").html(data);
            },
        });
    });
    $("body").off("click", ".pclose");
    $("body").on("click", ".pclose", function (e) {
        $(".dm-overlay").hide();
    });
</script>