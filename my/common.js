"use strict";
var _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(t) {
    return typeof t
} : function(t) {
    return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t
};
! function() {
    var t = {
        window: $(window),
        browser: function() {
            var t, e = navigator.userAgent,
                a = e.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [],
                i = function(t) {
                    return $("html").addClass(t.name + " " + t.name + t.version), t
                };
            return /trident/i.test(a[1]) ? (t = /\brv[ :]+(\d+)/g.exec(e) || [], i({
                name: "ie",
                version: t[1] || ""
            })) : "Chrome" === a[1] && null != (t = e.match(/\bOPR\/(\d+)/)) ? i({
                name: "opera",
                version: t[1]
            }) : (a = a[2] ? [a[1], a[2]] : [navigator.appName, navigator.appVersion, "-?"], null != (t = e.match(/version\/(\d+)/i)) && a.splice(1, 1, t[1]), i({
                name: a[0].toLowerCase(),
                version: a[1]
            }))
        }(),
        isMobile: function() {
            var t = /iphone|ipad|ipod|android|blackberry|mini|windowssce|palm/i.test(navigator.userAgent);
            return t && $(function() {
                $("html").addClass("is-mobile")
            }), t
        }(),
        uniFormBlackout: function(t) {
            var e, a = "static" == t.css("position");
            return a && t.css("position", "relative"), e = $('<div class="form-overlay"></div>').appendTo(t), e.css({
                    opacity: 0,
                    borderRadius: t.css("border-radius")
                }), e.animate({
                    opacity: .5
                }, 200),
                function() {
                    e.remove(), a && t.css("position", "static")
                }
        },
        uniFormError: function(e, a) {
            if (void 0 === a) e.find(".form__error:not([data-error-handler])").remove(), e.find(".form__error-handler").text("").attr("style", ""), e.find(".form__error").removeClass("error");
            else {
                $.each(a, function(a, i) {
                    if ("#" == a) "object" == (void 0 === i ? "undefined" : _typeof(i)) ? $$.alert(i.join("<br>")) : $$.alert(i);
                    else {
                        var o = e.find('[name="' + a + '"]'),
                            n = e.find('[data-error-handler="' + a + '"]');
                        n.length && (o = n), o.length && t.uniFormShowError(o, i)
                    }
                });
                var i = e.find("div.error:eq(0)");
                t.isElementOnView(i) || t.scrollTo(i)
            }
        },
        uniFormShowError: function(t, e) {
            console.log(t), t.is(":visible");
            var a = $('<div data-field-error class="text-danger"><span class="glyphicon glyphicon-warning form-control-feedback" aria-hidden="true"></span>' + e + "</div>"),
                i = t.closest(".form-group");
            "INPUT" == t[0].nodeName && a.addClass("form__error_nowrap form__error_" + t.attr("type")).attr("title", a.text());
            var o = !!i.find("[data-error-box]") && i.find("[data-error-box]");
            i.addClass("has-error"), o ? (o.find("[data-field-error]").remove(), o.append(a)) : i.append(a), a.click(function() {
                t.is("[data-error-handler]") ? t.click() : t.focus(), i.removeClass("has-error"), a.remove()
            }), t.on("focus", function() {
                i.removeClass("has-error"), a.remove()
            }), t.is("[data-error-handler]") && a.addClass("form__error-handler"), a.hide().fadeIn(100)
        },
        uniFormHandle: function(e, a) {
            e.on("submit", function(e) {
                e.preventDefault(), t.uniFormSubmit($(this), a)
            })
        },
        uniFormSubmit: function(e, a) {
            var i;
            if (a.success && (a.afterSuccess = a.success, delete a.success), e.find(".input__error").each(function() {
                    $(this).remove()
                }), !e.data("blocked")) {
                if (a.beforeData) {
                    if (!1 === a.beforeData(e)) return !1
                }
                a.overlay && (i = t.uniFormBlackout(!0 === a.overlay ? e : a.overlay)), e.data("blocked", !0);
                var o = (e.data("ignoreDefaultLoading"), location.protocol + "//" + location.hostname + location.pathname),
                    n = {
                        url: o
                    };
                return a.data && $.extend(n, a.data), a.beforeSubmit && a.beforeSubmit(e), e.find(".attach-images").each(function() {
                    var t = $(this),
                        e = t.find(".attach-images-item"),
                        a = t.siblings(".form-input-field").find("textarea, input"),
                        i = a.val();
                    e.each(function() {
                        var t = $(this);
                        t.data("id") && (i.match(new RegExp("\\[img=" + t.data("id") + "\\]", "ig")) || (i += "[img=" + t.data("id") + "]"))
                    }), a.val(i)
                }), e.ajaxSubmit({
                    dataType: "json",
                    data: n,
                    beforeSend: function() {
                        t.uniFormError(e)
                    },
                    complete: function() {
                        e.data("blocked", !1), a.overlay && i()
                    },
                    success: function(i) {
                        e.data("blocked", !1), i.error ? (t.uniFormError(e, i.error), a.afterData && a.afterData(e, i)) : i.success ? (e.find(".attach-images").remove(), a.afterData && a.afterData(e, i), a.afterSuccess && (a.afterSuccess(i, e), e.trigger("success", i)), i.$events && $.each(i.$events, function(t, e) {
                            $$.dispatcher.trigger(t, e)
                        })) : a.afterData && a.afterData(e, i)
                    },
                    error: function(t, e, a) {}
                }), !1
            }
        },
        createModalBox: function(t, e) {
            return $('<div class="modal-box ' + ("object" !== (void 0 === t ? "undefined" : _typeof(t)) ? t : "") + " " + (e && e.boxCssClass ? e.boxCssClass : "") + '"><i class="arcticmodal-close modal-box-close"></i><div class="modal-box-content"></div>')
        },
        openModal: function(t, e) {
            var a;
            if (e = e || {}, "object" === (void 0 === t ? "undefined" : _typeof(t)) && t.jquery) {
                var i = t.clone();
                return a = $$.createModalBox(t, e).find(".modal-box-content").html(e.title ? '<div class="modal-box-title">' + e.title + "</div>" : "").append(i).end(), $$.init.formPlugins(a), a.arcticmodal(e)
            }
            return a = $$.createModalBox(t).find(".modal-box-content").html((e.title ? '<div class="modal-box-title">' + e.title + "</div>" : "") + $("." + t).html()).end(), $$.init.formPlugins(a), a.arcticmodal(e)
        },
        morph: function(t, e, a, i) {
            return t = parseInt(t), (t = Math.abs(t) % 100) > 10 && t < 20 ? i : (t %= 10, t > 1 && t < 5 ? a : 1 == t ? e : i)
        },
        scrollTo: function(t, e, a, i) {
            if (!t.length) return !1;
            var o = "html:not(:animated), body:not(:animated)",
                n = !1,
                s = t.closest(".arcticmodal-container");
            s.length && (o = s.filter(":not(:animated)")), e || (e = 300), a || (a = 0);
            var r = {};
            t - 0 >= 0 ? r.top = t : r = t.offset(), a = r.top - a, r && ($(o).animate({
                scrollTop: a
            }, e, function() {
                i && !n && (n = !0, i())
            }), $(window).one("scroll", function() {
                $(o).stop(), i && !n && (n = !0, i())
            })), n = !1
        },
        isElementOnView: function(t, e) {
            if (!t.length) return !1;
            e || (e = 0);
            var a = $(window).scrollTop(),
                i = a + $(window).height(),
                o = $(t).offset().top;
            return o + $(t).height() <= i && o >= a + e
        },
        initPrettyPhoto: function(t) {
            $("a[rel^='prettyPhoto'], a[rel^='image'], a[rel^='media']", t).prettyPhoto({
                animation_speed: "fast",
                opacity: .6,
                show_title: !1,
                allow_resize: !0,
                default_width: 800,
                default_height: 600,
                counter_separator_label: " |В· ",
                theme: "overbyte",
                horizontal_padding: 20,
                hideflash: !1,
                wmode: "opaque",
                autoplay: !0,
                modal: !1,
                deeplinking: !1,
                overlay_gallery: !1,
                keyboard_shortcuts: !1,
                ie6_fallback: !0,
                social_tools: !1
            })
        },
        confirm: function(t) {
            var e = t.message ? t.message : arguments[0],
                a = t.onConfirm ? t.onConfirm : arguments[1],
                i = t.onCancel ? t.onCancel : arguments[2],
                o = $$.createModalBox("modal-box-message"),
                n = o.find(".modal-box-content");
            n.html('<div class="modal-box-tabled"><div class="modal-box-tabled-cell"><div class="modal-box-tabled-cell-body">' + e + "</div></div></div>"), $('<div class="modal-box-buttons modal-box-buttons--center"><button button="middle" class="button-confirm-action">OK</button><button  button="middle outline" class="button-cancel-action arcticmodal-close">Отмена</button></div></div>').insertAfter(n), o.arcticmodal(), o.find(".button-confirm-action")[0].focus(), i && o.find(".button-cancel-action").on("click", function() {
                i()
            }), o.find(".button-confirm-action").on("click", function() {
                o.arcticmodal("close"), a && a()
            })
        },
        alert: function(t, e) {
            ! function(t, e) {
                var a = $$.createModalBox("modal-box-message modal-box-alert");
                a.find(".modal-box-content").html(t + '<div class="modal-box-buttons modal-box-buttons_center"><button type="button" class="button arcticmodal-close">ОК</button></div>'), a.arcticmodal(), a.find("button")[0].focus();
                var i = e && e.onOk ? e.onOk : arguments[2];
                a.find("button").on("click", function() {
                    i && i()
                })
            }(t, e)
        },
        blockOverlay: function(t, e) {
            var a = t.data("block-overlay"),
                e = $.extend({
                    zIndex: 100,
                    opacity: .5,
                    position: "absolute",
                    top: 0,
                    left: 0,
                    right: 0,
                    bottom: 0,
                    background: "#fff"
                }, e);
            if (!a) return a = $('<div class="block-overlay" />').css(e), "static" == t.css("position") && t.css({
                position: "relative"
            }), t.data("block-overlay", a.appendTo(t)), a;
            t.removeData("block-overlay"), a.remove()
        }
    };
    ! function() {
        t.Tabs = function(t) {
            this.defaults = {
                tabs: "[js-tabs-tab]",
                panes: "[js-tabs-pane]",
                speed: 300,
                hash: !1,
                openFirst: !0,
                $parent: $("body")
            }, this.options = $.extend({}, this.defaults, t), this.$tabs = "string" == typeof this.options.tabs ? $(this.options.tabs) : this.options.tabs, this.$panes = "string" == typeof this.options.panes ? $(this.options.panes) : this.options.panes, this.groups = {}, this.init()
        };
        var e = t.Tabs.prototype;
        e.select = function(t, e, a) {
            var i = this,
                o = i.getPanes(t),
                n = o.filter('[data-tabs-pane~="' + t + ":" + e + '"]'),
                s = i.getTabs(t),
                r = s.filter('[data-tabs-tab~="' + t + ":" + e + '"]'),
                a = void 0 === a ? i.options.speed : a;
            n.length ? (s.removeClass("is-active"), r.removeClass("is-broken").addClass("is-active"), o.removeClass("is-hidden").stop().slideUp(a, function() {
                $(this).addClass("is-hidden")
            }), n.removeClass("is-hidden").stop().slideDown(a, function() {
                i.options.$parent.trigger({
                    type: "tabChanged",
                    tab: r,
                    pane: n,
                    group: t,
                    id: e
                })
            }), i.options.$parent.trigger({
                type: "tabChange",
                tab: r,
                pane: n,
                group: t,
                id: e
            })) : r.addClass("is-broken")
        }, e.getPanes = function(t) {
            return this.$panes.filter('[data-tabs-pane*="' + t + ':"]')
        }, e.getTabs = function(t) {
            return this.$tabs.filter('[data-tabs-tab*="' + t + ':"]')
        }, e.grouping = function() {
            var t = this,
                e = t.$tabs,
                a = t.groups;
            e.each(function(t, i) {
                var o = e.eq(t),
                    n = o.data("tabs-tab").split(":"),
                    s = n[0];
                void 0 === a[s] && (a[s] = new Array), a[s].push(n[1]), o.data("js-tabs", n)
            }), this.groups = a
        }, e.binding = function() {
            var t = this;
            this.$tabs.off(".js-tabs").on("click.js-tabs", function(e) {
                if (e.preventDefault(), $(this).hasClass("is-active")) return !1;
                var a = $(this).data("js-tabs"),
                    i = a[0],
                    o = a[1];
                t.select(i, o), t.options.hash && (location.hash = i + ":" + o)
            })
        }, e.parseHash = function() {
            return location.hash.substring(1).split(":")
        }, e.init = function() {
            var t = this,
                e = t.parseHash();
            t.$panes.removeAttr("style"), t.grouping(), t.binding(), t.options.hash && $(window).on("hashchange", function(a) {
                e = t.parseHash(), t.groups[e[0]] && t.select(e[0], e[1], 0)
            }), $.each(t.groups, function(a, i) {
                var o = t.getTabs(a),
                    n = t.getPanes(a),
                    s = o.filter(".is-active");
                t.options.hash && e.length && e[0] == a ? o.filter('[data-tabs-tab~="' + a + ":" + e[1] + '"]').is(":visible") && n.filter('[data-tabs-pane~="' + a + ":" + e[1] + '"]').length && t.select(a, e[1], 0) : s.length && s.is(":visible") ? t.select(s.data("js-tabs")[0], s.data("js-tabs")[1], 0) : t.options.openFirst ? t.select(o.eq(0).data("js-tabs")[0], o.eq(0).data("js-tabs")[1], 0) : (o.removeClass("is-active"), n.addClass("is-hidden").hide())
            })
        }
    }(), window.$$ = t
}(),
function() {
    var t = {
        createTabs: function(t) {
            return new $$.Tabs(t)
        },
        bindPopup: function(t) {
            if ($.fn.arcticmodal) {
                ("string" == typeof t ? $(t) : t).off(".open-modal").on("click.open-modal", function(t) {
                    t.preventDefault(), $$.openModal($($(this).data("modal")), {
                        closeOnEsc: !0,
                        closeOnOverlayClick: !0,
                        afterOpen: function(t, e) {
                            $$.init.formPlugins(e)
                        }
                    })
                })
            }
        },
        bindModal: function(t) {
            if ($.fn.arcticmodal) {
                ("string" == typeof t ? $(t) : t).off(".open-modal").on("click.open-modal", function(t) {
                    t.preventDefault(), $$.openModal($($(this).data("modal")), {
                        closeOnEsc: !1,
                        closeOnOverlayClick: !0,
                        beforeOpen: function(t, e) {
                            e.addClass("animated animate-wait fadeInUp")
                        },
                        afterOpen: function(t, e) {
                            $$.init.formPlugins(e)
                        }
                    })
                })
            }
        }
    };
    window.Helper = t
}(), $.fn.formHandle = function(t) {
        return t = t || {}, this.each(function() {
            $$.uniFormHandle($(this), t)
        }), this
    }, $.fn.selectus = function(t) {
        return $(this).each(function(t, e) {
            var a = $(e);
            if (a.data("selectus")) return void a.triggerHandler("update");
            var i = a.children("option"),
                o = $('<div class="selectus"><div class="selectus-input"><input type="text" name="selectus_input" value=""><div class="selectus-drop"></div></div></div>'),
                n = o.find("input").prop("disabled", !0),
                s = a.data("selectus-prefix");
            a.attr("disabled") && o.addClass("is-disabled"), a.replaceWith(o), a.prependTo(o), n.val(i.filter(":selected").text()), a.off(".selectus").on({
                "change.selectus silentChange.selectus": function(t) {
                    var e = i.filter(":selected").text();
                    n.val(e != s && s ? s + ": " + e : e)
                },
                "update.selectus": function(t) {
                    a = $(this), o = a.closest(".selectus"), n = o.find("input"), i = a.children("option"), a.trigger("silentChange")
                },
                "destroy.selectus": function(t) {
                    o.replaceWith(a.off(".selectus").data("selectus", !1))
                },
                "select.selectus": function(t, e) {
                    isNaN(e.id) ? e.value && (i.filter(function(t, a) {
                        return i.eq(t).attr("value") == e.value
                    }).prop("selected", !0), a.trigger("silentChange")) : (i.eq(e.id).prop("selected", !0), a.trigger("silentChange"))
                }
            }).data("selectus", !0)
        })
    },
    function(t) {
        t.fn.inputFile = function() {
            return t(this).each(function(e, a) {
                var i = t(a);
                if (!i.data("init")) {
                    i.data("init", !0), i.wrap("<label class='input-file'> </label>");
                    var o = i.attr("js-input-name"),
                        n = '<div class="input-file__wrapper"><div class="input-file__icon"></div><div class="input-file__text">' + o + "</div></div>";
                    i.after(n), i.on("change", function() {
                        var e = t(this).val(),
                            a = e.split("\\");
                        if (a.length > 1) var e = a[a.length - 1];
                        if (0 != e) {
                            t(this).next().remove();
                            var i = '<div class="input-file__wrapper"><div class="input-file__icon"></div><div class="input-file__text">' + e + '</div><div class="input-file__close"></div></div>';
                            t(this).after(i), t(".input-file__close").on("click", function() {
                                return t(this).parent().prev().val(""), t(this).parent().prev().prop("disabled", !1), t(this).parent().html(n), !1
                            })
                        }
                    })
                }
            })
        }, t.fn.inputShadow = function() {
            return t(this).each(function(e, a) {
                var i = t(a),
                    o = i.find("input, textarea");
                i.removeClass("is-focused is-filled"), o.off(".input-shadow").on({
                    "focus.input-shadow": function(t) {
                        i.addClass("is-focused")
                    },
                    "blur.input-shadow": function(t) {
                        i.removeClass("is-focused")
                    },
                    "keyup.input-shadow": function(t) {
                        i.hasClass("is-error") && o.val().length > 0 && i.removeClass("is-error")
                    },
                    "change.input-shadow changeSilent.input-shadow": function(t) {
                        o.val().length > 0 ? i.addClass("is-filled") : i.removeClass("is-filled")
                    }
                }).trigger("changeSilent")
            })
        }
    }(jQuery), $.arcticmodal("setDefault", {
        modal: !1,
        closeOnEsc: !1,
        openEffect: {
            type: "none"
        },
        closeEffect: {
            type: "none"
        },
        fixed: ".header__top",
        closeOnOverlayClick: !0
    }), $(function() {
        $$.$body = $("body"), $$.isMobile && $("html").addClass("is-mobile");
        var t = {
            fastclick: function() {
                $$.$body.find("a, button, input").on("touchstart", function() {})
            },
            sticky: function(t) {
                !$$.isMobile && $.fn.Stickyfill && $(".sticky", t).Stickyfill()
            },
            popup: function(t) {
                Helper.bindPopup($("[js-open-popup]", t))
            },
            modal: function(t) {
                Helper.bindModal($("[js-open-modal]", t))
            },
            tabs: function() {
                Helper.createTabs()
            },
            formPlugins: function(t) {
                $("[js-selectus]", t).selectus(), $("[js-input]", t).inputShadow(), $("[js-input-files]", t).inputFile(), $("[js-form]", t).formHandle({
                    beforeData: function(t) {},
                    afterData: function() {},
                    success: function(t, e) {
                        t.clear_form && e.resetForm(), t.alert ? $.fancybox.open('<div class="message">' + t.alert + "</div>") : e.closest("div").slideUp(function() {
                            e.closest("div").html('<div class="form__success">' + (t.success_text ? t.success_text : t.message) + "</div>").slideDown()
                        }), t.redirect && (t.alert ? setTimeout(function() {
                            document.location.href = t.redirect
                        }, 2e3) : document.location.href = t.redirect), setTimeout(function() {
                            $.arcticmodal("close")
                        }, 2500), t.error
                    }.bind(this)
                }), this.phoneMask(t), this.inputmask(t)
            },
            inputmask: function(t) {
                $("[data-inputmask]", t).inputmask()
            },
            phoneMask: function(t) {
                $('[data-masked="phone"]', t).inputmask("+33(999)-999-9999", {
                    showMaskOnHover: !1
                })
            }
        };
        t.all = function(t) {
            $("[js-input-file]", t).inputFile(), $$.init.formPlugins(), $$.init.modal()
        }, $$.init = t, $$.init.all()
    }), $(function() {
        $$.CalcModel = Backbone.Model.extend({
            defaults: {
                data: {
                    total: 0,
                    price: {
                        base: 0,
                        options: 0
                    },
                    square: 1
                }
            },
            initialize: function() {},
            validator: function() {}
        }), $$.CalcView = Backbone.View.extend({
            fields: null,
            events: {
                "blur [data-calculator-field]": "setData",
                "change [data-calculator-field]": "setData",
                "keydown [data-calculator-field]": "notSubmit",
                "click [data-set-select]": "setSelect"
            },
            initialize: function() {
                this.listenTo(this.model, "change", this.render);
                var t = this.model.get("data");
                this.fields = this.$("[data-calculator-field]"), t.price.base = parseFloat(this.$("[name=item_price]").val()) + parseFloat(this.$("[name=kind_price]").val()), t.square = 1, $(document).on("change", "[data-checkbox-repeater]", function(t) {
                    this.setCheckbox(t)
                }.bind(this)), $(document).on("click", "[data-set-select]", function(t) {
                    this.setSelect(t)
                }.bind(this))
            },
            render: function() {

                var t = this.model.get("data"),
                    e = !0;
                this.$el.find("[data-final-square]").html(t.square), this.fields.each(function(t, a) {
                    var i = $(a),
                        o = i.find("option:selected").val() || i.val() || i.find("input[type=checkbox]").filter(":checked").first().val(),
                        n = i.data("calculator-id");
                    if (console.log(i.data("require")), !i.data("require") || o || i.closest("[data-calculator-question]").hasClass("hidden") || (e = !1), o) {
                        this.$("[data-calculator-behavior=" + n + "]").each(function(t, e) {
                            var a = $(e);
                            a.data("calculator-behavior") && a.data("calculator-behavior").toString() === n.toString() && (a.data("calculator-behavior-value") ? a.data("calculator-behavior-value").toString() === o.toString() ? a.closest("[data-calculator-question]").hasClass("hidden") && a.closest("[data-calculator-question]").removeClass("hidden").slideUp(1).slideDown() : (a.closest("[data-calculator-question]").addClass("hidden"), a.val("").prop("selectedIndex", 0), $("[data-calculator-behavior=" + a.data("calculator-id") + "]").closest("[data-calculator-question]").addClass("hidden")) : o ? a.closest("[data-calculator-question]").hasClass("hidden") && a.closest("[data-calculator-question]").removeClass("hidden").slideUp(1).slideDown() : a.closest("[data-calculator-question]").addClass("hidden"))
                        })
                    }
                }.bind(this)), t.total && e ? (this.$el.find("button[type=submit]").removeAttr("disabled"), this.$el.find("[data-final-result]").removeClass("hidden"), this.$el.find("[data-final-price]").text(t.total.toLocaleString("fr-FR"))) : (this.$el.find("button[type=submit]").attr("disabled", "disabled"), this.$el.find("[data-final-result]").addClass("hidden"), this.$el.find("[data-final-price]").text(""))
            },
            setData: function(t) {
                this.render();
                var e, a = this.model.get("data");
                a.square = 1, a.price.options = 0, this.fields.each(function(t, i) {
                    if (e = $(i), !e.closest("[data-calculator-question]").hasClass("hidden")) {
                        var o = parseFloat(e.attr("multiplier")) || 1;
                        if ("select" === e.data("calculator-field") || "product" === e.data("calculator-field")) a.price.options += parseFloat(e.find("option:selected").data("price")) * o;
                        else if ("counter" === e.data("calculator-field")) console.log(e, e.data("price"), e.val()), a.price.options += parseFloat(e.data("price")) * parseFloat(e.val());
                        else if ("checkbox_list" === e.data("calculator-field")) e.find("input:checked").each(function(t) {
                            a.price.options += parseFloat($(this).data("price")) * o
                        });
                        else if ("multiplier" === e.data("calculator-field")) {
                            var n = this.fields.filter("[data-calculator-id=" + e.data("calculator-behavior") + "]");
                            n.attr("multiplier", e.val())
                        } else "square" === e.data("calculator-field") && (a.square === parseFloat(1) ? a.square += parseFloat(e.val()) - 1 : a.square += parseFloat(e.val()))
                    }
                }.bind(this)), a.total = (a.price.base + a.price.options) * a.square, this.model.set({
                    data: a
                }, {
                    validator: !0
                }), this.render()
            },
            setSelect: function(t) {
                var e = $(t.target);
                e.data("set-option") && (e.closest(".product-row").find("[data-set-select]").addClass("btn-default").removeClass("btn-primary disabled"), $("[data-calculator-id=" + e.data("set-select") + "]").val(e.data("set-option")).find("option [value=" + e.data("set-option") + "]").attr("selected", "selected"), e.removeClass("btn-default").addClass("btn-primary disabled")), this.setData()
            },
            setCheckbox: function(t) {
                var e = $(t.target);
                e.data("checkbox-repeater") && this.$el.find("[data-id=" + e.data("checkbox-repeater") + "]").prop("checked", e.prop("checked")).trigger("change")
            },
            notSubmit: function(t) {
                if (13 === t.keyCode) return t.preventDefault(), $(":focus").trigger("blur"), !1
            }
        });
        var t = new $$.CalcModel;
        new $$.CalcView({
            model: t,
            el: "#calculator"
        });
        window.location.hash && $('.calculator__categories a[href="' + window.location.hash + '"]').tab("show")
    }), $(function() {
        $("[data-carousel]").owlCarousel({
            autoplayHoverPause: !0,
            loop: !0,
            margin: 0,
            nav: !1,
            dots: !0,
            autoplay: !0,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1e3: {
                    items: 1
                }
            }
        })
    }), $(function() {
        $('a[href^="#"]').on("click", function(t) {
            t.preventDefault(), $$.scrollTo($($(this).attr("href")))
        }), $('[data-toggle="tooltip"]').tooltip(), $('[data-toggle="popover"]').popover(), $('[data-in-anchor="true"]').on("click", function(t) {
            t.stopPropagation(), t.preventDefault()
        })
    }), $(function() {
        $("[data-fancybox]").fancybox({
            afterShow: function(t, e) {
                $$.init.formPlugins()
            }
        })
    });