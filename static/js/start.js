/*
 * Copyright (c) 2018.
 * KarmaTechs
 * Evan Karma Alias MADSkill
 * madskill.madskill@gmail.com
 * https://sociamater.com
 */
function display_price(e, t) {
  $("strong.buynow-figure").text("$" + e), $("strong.prepaid-figure").text("$" + t)
}
function choose_licence(e) {
  var t, n, r;
  $("#buynow-form input[name=licence], #prepaid-form input[name=licence]").val(e), t = $(".sizes [name=purchasable]:checked").val(), t || (t = "source"), n = prices_by_licence_and_size[e][t].buy_now, r = prices_by_licence_and_size[e][t].prepaid, display_price(n, r)
}
function choose_purchasable(e) {
  var t, n, r;
  $("#buynow-form input[name=purchasable], #prepaid-form input[name=purchasable]").val(e), t = $(".js-open .price_in_dollars:first").attr("data-licence"), n = prices_by_licence_and_size[t][e].buy_now, r = prices_by_licence_and_size[t][e].prepaid, r === n ? $("small.surcharge").hide() : $("small.surcharge").show(), $(".price_in_dollars").each(function(t) {
    var n = $(this);
    n.text(prices_by_licence_and_size[n.attr("data-licence")][e].prepaid)
  }), display_price(n, r)
}
function submit_purchase_form(e) {
  var t = $(e).parent().siblings("form"),
    n = $("input[name=webtrends_si_n]", t),
    r = $("input[name=webtrends_si_x]", t);
  n.length === 1 && r.length === 1 && dcsMultiTrack("WT.si_n", n.val(), "WT.si_z", r.val()), t.submit()
}
function confirm_purchase(e, t) {
  return confirm("You are about to purchase " + e + " (from the " + t + " category) using your prepaid balance.\n\nPlease review the item attributes to ensure this item suits your needs. We can only issue a refund if the item has not been downloaded, is faulty, or does not work as described on the item page.\n\nBy clicking okay you will immediately purchase this item.")
}
function bindAudioPlayerClickEvent() {
  $("#content").on("click.audio_player", ".audio_player", function(e) {
    return MiniPlayer.removeImg(e.target), MiniPlayer.addSWF(e.target), !1
  })
}
function objectWithPrototype(e, t) {
  function i() {}
  var n, r;
  i.prototype = e, n = new i, n.prototype = e;
  if(typeof t != "undefined") for(r in t) t.hasOwnProperty(r) && (n[r] = t[r]);
  return n
}
jQuery.cookie = function(e, t, n) {
  if(arguments.length > 1 && String(t) !== "[object Object]") {
    n = jQuery.extend({}, n);
    if(t === null || t === undefined) n.expires = -1;
    if(typeof n.expires == "number") {
      var r = n.expires,
        i = n.expires = new Date;
      i.setDate(i.getDate() + r)
    }
    return t = String(t), document.cookie = [encodeURIComponent(e), "=", n.raw ? t : encodeURIComponent(t), n.expires ? "; expires=" + n.expires.toUTCString() : "", n.path ? "; path=" + n.path : "", n.domain ? "; domain=" + n.domain : "", n.secure ? "; secure" : ""].join("")
  }
  n = t || {};
  var s, o = n.raw ? function(e) {
      return e
    } : decodeURIComponent;
  return(s = (new RegExp("(?:^|; )" + encodeURIComponent(e) + "=([^;]*)")).exec(document.cookie)) ? o(s[1]) : null
},
function(e) {
  var t, n, r, i, s, o, u, a, f, l = 0,
    c = {}, h = [],
    p = 0,
    d = {}, v = [],
    m = null,
    g = new Image,
    y = /\.(jpg|gif|png|bmp|jpeg)(.*)?$/i,
    b = /[^\.]\.(swf)\s*$/i,
    w, E = 1,
    S, x, T = !1,
    N = 20,
    C = e.extend(e("<div/>")[0], {
      prop: 0
    }),
    k = 0,
    L = !e.support.opacity && !window.XMLHttpRequest,
    A = function() {
      n.hide(), g.onerror = g.onload = null, m && m.abort(), t.empty()
    }, O = function() {
      e.fancybox('<p id="fancybox_error">The requested content cannot be loaded.<br />Please try again later.</p>', {
        scrolling: "no",
        padding: 20,
        transitionIn: "none",
        transitionOut: "none"
      })
    }, M = function() {
      return [e(window).width(), e(window).height(), e(document).scrollLeft(), e(document).scrollTop()]
    }, _ = function() {
      var e = M(),
        t = {}, n = d.margin,
        r = d.autoScale,
        i = (N + n) * 2,
        s = (N + n) * 2,
        o = d.padding * 2,
        u;
      return d.width.toString().indexOf("%") > -1 ? (t.width = e[0] * parseFloat(d.width) / 100 - N * 2, r = !1) : t.width = d.width + o, d.height.toString().indexOf("%") > -1 ? (t.height = e[1] * parseFloat(d.height) / 100 - N * 2, r = !1) : t.height = d.height + o, r && (t.width > e[0] - i || t.height > e[1] - s) && (c.type == "image" || c.type == "swf" ? (i += o, s += o, u = Math.min(Math.min(e[0] - i, d.width) / d.width, Math.min(e[1] - s, d.height) / d.height), t.width = Math.round(u * (t.width - o)) + o, t.height = Math.round(u * (t.height - o)) + o) : (t.width = Math.min(t.width, e[0] - i), t.height = Math.min(t.height, e[1] - s))), t.top = e[3] + (e[1] - (t.height + N * 2)) * .5, t.left = e[2] + (e[0] - (t.width + N * 2)) * .5, d.autoScale === !1 && (t.top = Math.max(e[3] + n, t.top), t.left = Math.max(e[2] + n, t.left)), t
    }, D = function(e) {
      if(e && e.length) switch(d.titlePosition) {
      case "inside":
        return e;
      case "over":
        return '<span id="fancybox-title-over">' + e + "</span>";
      default:
        return '<span id="fancybox-title-wrap"><span id="fancybox-title-left"></span><span id="fancybox-title-main">' + e + '</span><span id="fancybox-title-right"></span></span>'
      }
      return !1
    }, P = function() {
      var t = d.title,
        n = x.width - d.padding * 2,
        r = "fancybox-title-" + d.titlePosition;
      e("#fancybox-title").remove(), k = 0;
      if(d.titleShow === !1) return;
      t = e.isFunction(d.titleFormat) ? d.titleFormat(t, v, p, d) : D(t);
      if(!t || t === "") return;
      e('<div id="fancybox-title" class="' + r + '" />').css({
        width: n,
        paddingLeft: d.padding,
        paddingRight: d.padding
      }).html(t).appendTo("body");
      switch(d.titlePosition) {
      case "inside":
        k = e("#fancybox-title").outerHeight(!0) - d.padding, x.height += k;
        break;
      case "over":
        e("#fancybox-title").css("bottom", d.padding);
        break;
      default:
        e("#fancybox-title").css("bottom", e("#fancybox-title").outerHeight(!0) * -1)
      }
      e("#fancybox-title").appendTo(s).hide()
    }, H = function() {
      e(document).unbind("keydown.fb").bind("keydown.fb", function(t) {
        t.keyCode == 27 && d.enableEscapeButton ? (t.preventDefault(), e.fancybox.close()) : t.keyCode == 37 && d.enableArrowButtons ? (t.preventDefault(), e.fancybox.prev()) : t.keyCode == 39 && d.enableArrowButtons && (t.preventDefault(), e.fancybox.next())
      }), e.fn.mousewheel && (i.unbind("mousewheel.fb"), v.length > 1 && i.bind("mousewheel.fb", function(t, n) {
        t.preventDefault();
        if(T || n === 0) return;
        n > 0 ? e.fancybox.prev() : e.fancybox.next()
      }));
      if(!d.showNavArrows) return;
      (d.cyclic && v.length > 1 || p !== 0) && a.show(), (d.cyclic && v.length > 1 || p != v.length - 1) && f.show()
    }, B = function() {
      var e, t;
      v.length - 1 > p && (e = v[p + 1].href, typeof e != "undefined" && e.match(y) && (t = new Image, t.src = e)), p > 0 && (e = v[p - 1].href, typeof e != "undefined" && e.match(y) && (t = new Image, t.src = e))
    }, j = function() {
      o.css("overflow", d.scrolling == "auto" ? d.type == "image" || d.type == "iframe" || d.type == "swf" ? "hidden" : "auto" : d.scrolling == "yes" ? "auto" : "visible"), e.support.opacity || (o.get(0).style.removeAttribute("filter"), i.get(0).style.removeAttribute("filter")), e("#fancybox-title").show(), d.hideOnContentClick && o.one("click", e.fancybox.close), d.hideOnOverlayClick && r.one("click", e.fancybox.close), d.showCloseButton && u.show(), H(), e(window).bind("resize.fb", e.fancybox.center), d.centerOnScroll ? e(window).bind("scroll.fb", e.fancybox.center) : e(window).unbind("scroll.fb"), e.isFunction(d.onComplete) && d.onComplete(v, p, d), T = !1, B()
    }, F = function(e) {
      var t = Math.round(S.width + (x.width - S.width) * e),
        n = Math.round(S.height + (x.height - S.height) * e),
        r = Math.round(S.top + (x.top - S.top) * e),
        s = Math.round(S.left + (x.left - S.left) * e);
      i.css({
        width: t + "px",
        height: n + "px",
        top: r + "px",
        left: s + "px"
      }), t = Math.max(t - d.padding * 2, 0), n = Math.max(n - (d.padding * 2 + k * e), 0), o.css({
        width: t + "px",
        height: n + "px"
      }), typeof x.opacity != "undefined" && i.css("opacity", e < .5 ? .5 : e)
    }, I = function(e) {
      var t = e.offset();
      return t.top += parseFloat(e.css("paddingTop")) || 0, t.left += parseFloat(e.css("paddingLeft")) || 0, t.top += parseFloat(e.css("border-top-width")) || 0, t.left += parseFloat(e.css("border-left-width")) || 0, t.width = e.width(), t.height = e.height(), t
    }, q = function() {
      var t = c.orig ? e(c.orig) : !1,
        n = {}, r, i;
      return t && t.length ? (r = I(t), n = {
        width: r.width + d.padding * 2,
        height: r.height + d.padding * 2,
        top: r.top - d.padding - N,
        left: r.left - d.padding - N
      }) : (i = M(), n = {
        width: 1,
        height: 1,
        top: i[3] + i[1] * .5,
        left: i[2] + i[0] * .5
      }), n
    }, R = function() {
      n.hide();
      if(i.is(":visible") && e.isFunction(d.onCleanup) && d.onCleanup(v, p, d) === !1) {
        e.event.trigger("fancybox-cancel"), T = !1;
        return
      }
      v = h, p = l, d = c, o.get(0).scrollTop = 0, o.get(0).scrollLeft = 0, d.overlayShow && (L && e("select:not(#fancybox-tmp select)").filter(function() {
        return this.style.visibility !== "hidden"
      }).css({
        visibility: "hidden"
      }).one("fancybox-cleanup", function() {
        this.style.visibility = "inherit"
      }), r.css({
        "background-color": d.overlayColor,
        opacity: d.overlayOpacity
      }).unbind().show()), x = _(), P();
      if(i.is(":visible")) {
        e(u.add(a).add(f)).hide();
        var s = i.position(),
          m;
        S = {
          top: s.top,
          left: s.left,
          width: i.width(),
          height: i.height()
        }, m = S.width == x.width && S.height == x.height, o.fadeOut(d.changeFade, function() {
          var n = function() {
            o.html(t.contents()).fadeIn(d.changeFade, j)
          };
          e.event.trigger("fancybox-change"), o.empty().css("overflow", "hidden"), m ? (o.css({
            top: d.padding,
            left: d.padding,
            width: Math.max(x.width - d.padding * 2, 1),
            height: Math.max(x.height - d.padding * 2 - k, 1)
          }), n()) : (o.css({
            top: d.padding,
            left: d.padding,
            width: Math.max(S.width - d.padding * 2, 1),
            height: Math.max(S.height - d.padding * 2, 1)
          }), C.prop = 0, e(C).animate({
            prop: 1
          }, {
            duration: d.changeSpeed,
            easing: d.easingChange,
            step: F,
            complete: n
          }))
        });
        return
      }
      i.css("opacity", 1), d.transitionIn == "elastic" ? (S = q(), o.css({
        top: d.padding,
        left: d.padding,
        width: Math.max(S.width - d.padding * 2, 1),
        height: Math.max(S.height - d.padding * 2, 1)
      }).html(t.contents()), i.css(S).show(), d.opacity && (x.opacity = 0), C.prop = 0, e(C).animate({
        prop: 1
      }, {
        duration: d.speedIn,
        easing: d.easingIn,
        step: F,
        complete: j
      })) : (o.css({
        top: d.padding,
        left: d.padding,
        width: Math.max(x.width - d.padding * 2, 1),
        height: Math.max(x.height - d.padding * 2 - k, 1)
      }).html(t.contents()), i.css(x).fadeIn(d.transitionIn == "none" ? 0 : d.speedIn, j))
    }, U = function() {
      t.width(c.width), t.height(c.height), c.width == "auto" && (c.width = t.width()), c.height == "auto" && (c.height = t.height()), R()
    }, z = function() {
      T = !0, c.width = g.width, c.height = g.height, e("<img />").attr({
        id: "fancybox-img",
        src: g.src,
        alt: c.title
      }).appendTo(t), R()
    }, W = function() {
      A();
      var n = h[l],
        r, i, s, u, a, f, p;
      c = e.extend({}, e.fn.fancybox.defaults, typeof e(n).data("fancybox") == "undefined" ? c : e(n).data("fancybox")), s = n.title || e(n).title || c.title || "", n.nodeName && !c.orig && (c.orig = e(n).children("img:first").length ? e(n).children("img:first") : e(n)), s === "" && c.orig && (s = c.orig.attr("alt")), n.nodeName && /^(?:javascript|#)/i.test(n.href) ? r = c.href || null : r = c.href || n.href || null, c.type ? (i = c.type, r || (r = c.content)) : c.content ? i = "html" : r ? r.match(y) ? i = "image" : r.match(b) ? i = "swf" : e(n).hasClass("iframe") ? i = "iframe" : r.match(/#/) ? (n = r.substr(r.indexOf("#")), i = e(n).length > 0 ? "inline" : "ajax") : i = "ajax" : i = "inline", c.type = i, c.href = r, c.title = s, c.autoDimensions && c.type !== "iframe" && c.type !== "swf" && (c.width = "auto", c.height = "auto"), c.modal && (c.overlayShow = !0, c.hideOnOverlayClick = !1, c.hideOnContentClick = !1, c.enableEscapeButton = !1, c.showCloseButton = !1);
      if(e.isFunction(c.onStart) && c.onStart(h, l, c) === !1) {
        T = !1;
        return
      }
      t.css("padding", N + c.padding + c.margin), e(".fancybox-inline-tmp").unbind("fancybox-cancel").bind("fancybox-change", function() {
        e(this).replaceWith(o.children())
      });
      switch(i) {
      case "html":
        t.html(c.content), U();
        break;
      case "inline":
        e('<div class="fancybox-inline-tmp" />').hide().insertBefore(e(n)).bind("fancybox-cleanup", function() {
          e(this).replaceWith(o.children())
        }).bind("fancybox-cancel", function() {
          e(this).replaceWith(t.children())
        }), e(n).appendTo(t), U();
        break;
      case "image":
        T = !1, e.fancybox.showActivity(), g = new Image, g.onerror = function() {
          O()
        }, g.onload = function() {
          g.onerror = null, g.onload = null, z()
        }, g.src = r;
        break;
      case "swf":
        u = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' + c.width + '" height="' + c.height + '"><param name="movie" value="' + r + '"></param>', a = "", e.each(c.swf, function(e, t) {
          u += '<param name="' + e + '" value="' + t + '"></param>', a += " " + e + '="' + t + '"'
        }), u += '<embed src="' + r + '" type="application/x-shockwave-flash" width="' + c.width + '" height="' + c.height + '"' + a + "></embed></object>", t.html(u), U();
        break;
      case "ajax":
        f = r.split("#", 2), p = c.ajax.data || {}, f.length > 1 && (r = f[0], typeof p == "string" ? p += "&selector=" + f[1] : p.selector = f[1]), T = !1, e.fancybox.showActivity(), m = e.ajax(e.extend(c.ajax, {
          url: r,
          data: p,
          error: O,
          success: function(e, n, r) {
            m.status == 200 && (t.html(e), U())
          }
        }));
        break;
      case "iframe":
        e('<iframe id="fancybox-frame" name="fancybox-frame' + (new Date).getTime() + '" frameborder="0" hspace="0" scrolling="' + c.scrolling + '" src="' + c.href + '"></iframe>').appendTo(t), R()
      }
    }, X = function() {
      if(!n.is(":visible")) {
        clearInterval(w);
        return
      }
      e("div", n).css("top", E * -40 + "px"), E = (E + 1) % 12
    }, V = function() {
      if(e("#fancybox-wrap").length) return;
      e("body").append(t = e('<div id="fancybox-tmp"></div>'), n = e('<div id="fancybox-loading"><div></div></div>'), r = e('<div id="fancybox-overlay"></div>'), i = e('<div id="fancybox-wrap"></div>')), e.support.opacity || (i.addClass("fancybox-ie"), n.addClass("fancybox-ie")), s = e('<div id="fancybox-outer"></div>').append('<div class="fancy-bg" id="fancy-bg-n"></div><div class="fancy-bg" id="fancy-bg-ne"></div><div class="fancy-bg" id="fancy-bg-e"></div><div class="fancy-bg" id="fancy-bg-se"></div><div class="fancy-bg" id="fancy-bg-s"></div><div class="fancy-bg" id="fancy-bg-sw"></div><div class="fancy-bg" id="fancy-bg-w"></div><div class="fancy-bg" id="fancy-bg-nw"></div>').appendTo(i), s.append(o = e('<div id="fancybox-inner"></div>'), u = e('<a id="fancybox-close"></a>'), a = e('<a href="javascript:;" id="fancybox-left"><span class="fancy-ico" id="fancybox-left-ico"></span></a>'), f = e('<a href="javascript:;" id="fancybox-right"><span class="fancy-ico" id="fancybox-right-ico"></span></a>')), u.click(e.fancybox.close), n.click(e.fancybox.cancel), a.click(function(t) {
        t.preventDefault(), e.fancybox.prev()
      }), f.click(function(t) {
        t.preventDefault(), e.fancybox.next()
      }), L && (r.get(0).style.setExpression("height", "document.body.scrollHeight > document.body.offsetHeight ? document.body.scrollHeight : document.body.offsetHeight + 'px'"), n.get(0).style.setExpression("top", "(-20 + (document.documentElement.clientHeight ? document.documentElement.clientHeight/2 : document.body.clientHeight/2 ) + ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop )) + 'px'"), s.prepend('<iframe id="fancybox-hide-sel-frame" src="javascript:\'\';" scrolling="no" frameborder="0" ></iframe>'))
    };
  e.fn.fancybox = function(t) {
    return e(this).data("fancybox", e.extend({}, t, e.metadata ? e(this).metadata() : {})).unbind("click.fb").bind("click.fb", function(t) {
      t.preventDefault();
      if(T) return;
      T = !0, e(this).blur(), h = [], l = 0;
      var n = e(this).attr("rel") || "";
      return !n || n == "" || n === "nofollow" ? h.push(this) : (h = e("a[rel=" + n + "], area[rel=" + n + "]"), l = h.index(this)), W(), !1
    }), this
  }, e.fancybox = function(t) {
    if(T) return;
    T = !0;
    var n = typeof arguments[1] != "undefined" ? arguments[1] : {};
    h = [], l = n.index || 0;
    if(e.isArray(t)) {
      for(var r = 0, i = t.length; r < i; r++) typeof t[r] == "object" ? e(t[r]).data("fancybox", e.extend({}, n, t[r])) : t[r] = e({}).data("fancybox", e.extend({
        content: t[r]
      }, n));
      h = jQuery.merge(h, t)
    } else typeof t == "object" ? e(t).data("fancybox", e.extend({}, n, t)) : t = e({}).data("fancybox", e.extend({
      content: t
    }, n)), h.push(t);
    if(l > h.length || l < 0) l = 0;
    W()
  }, e.fancybox.showActivity = function() {
    clearInterval(w), n.show(), w = setInterval(X, 66)
  }, e.fancybox.hideActivity = function() {
    n.hide()
  }, e.fancybox.next = function() {
    return e.fancybox.pos(p + 1)
  }, e.fancybox.prev = function() {
    return e.fancybox.pos(p - 1)
  }, e.fancybox.pos = function(e) {
    if(T) return;
    e = parseInt(e, 10), e > -1 && v.length > e && (l = e, W()), d.cyclic && v.length > 1 && e < 0 && (l = v.length - 1, W()), d.cyclic && v.length > 1 && e >= v.length && (l = 0, W());
    return
  }, e.fancybox.cancel = function() {
    if(T) return;
    T = !0, e.event.trigger("fancybox-cancel"), A(), c && e.isFunction(c.onCancel) && c.onCancel(h, l, c), T = !1
  }, e.fancybox.close = function() {
    function t() {
      r.fadeOut("fast"), i.hide(), e.event.trigger("fancybox-cleanup"), o.empty(), e.isFunction(d.onClosed) && d.onClosed(v, p, d), v = c = [], p = l = 0, d = c = {}, T = !1
    }
    if(T || i.is(":hidden")) return;
    T = !0;
    if(d && e.isFunction(d.onCleanup) && d.onCleanup(v, p, d) === !1) {
      T = !1;
      return
    }
    A(), e(u.add(a).add(f)).hide(), e("#fancybox-title").remove(), i.add(o).add(r).unbind(), e(window).unbind("resize.fb scroll.fb"), e(document).unbind("keydown.fb"), o.css("overflow", "hidden");
    if(d.transitionOut == "elastic") {
      S = q();
      var n = i.position();
      x = {
        top: n.top,
        left: n.left,
        width: i.width(),
        height: i.height()
      }, d.opacity && (x.opacity = 1), C.prop = 1, e(C).animate({
        prop: 0
      }, {
        duration: d.speedOut,
        easing: d.easingOut,
        step: F,
        complete: t
      })
    } else i.fadeOut(d.transitionOut == "none" ? 0 : d.speedOut, t)
  }, e.fancybox.resize = function() {
    var t, n;
    if(T || i.is(":hidden")) return;
    T = !0, t = o.wrapInner("<div style='overflow:auto'></div>").children(), n = t.height(), i.css({
      height: n + d.padding * 2 + k
    }), o.css({
      height: n
    }), t.replaceWith(t.children()), e.fancybox.center()
  }, e.fancybox.center = function() {
    T = !0;
    var e = M(),
      t = d.margin,
      n = {};
    n.top = e[3] + (e[1] - (i.height() - k + N * 2)) * .5, n.left = e[2] + (e[0] - (i.width() + N * 2)) * .5, n.top = Math.max(e[3] + t, n.top), n.left = Math.max(e[2] + t, n.left), i.css(n), T = !1
  }, e.fn.fancybox.defaults = {
    padding: 10,
    margin: 20,
    opacity: !1,
    modal: !1,
    cyclic: !1,
    scrolling: "auto",
    width: 560,
    height: 340,
    autoScale: !0,
    autoDimensions: !0,
    centerOnScroll: !1,
    ajax: {},
    swf: {
      wmode: "transparent"
    },
    hideOnOverlayClick: !0,
    hideOnContentClick: !1,
    overlayShow: !0,
    overlayOpacity: .3,
    overlayColor: "#666",
    titleShow: !0,
    titlePosition: "outside",
    titleFormat: null,
    transitionIn: "fade",
    transitionOut: "fade",
    speedIn: 300,
    speedOut: 300,
    changeSpeed: 300,
    changeFade: "fast",
    easingIn: "swing",
    easingOut: "swing",
    showCloseButton: !0,
    showNavArrows: !0,
    enableEscapeButton: !0,
    enableArrowButtons: !0,
    onStart: null,
    onCancel: null,
    onComplete: null,
    onCleanup: null,
    onClosed: null
  }, e(document).ready(function() {
    V()
  })
}(jQuery),
function(e, t) {
  var n = function(e) {
    var t, n = [];
    for(t in e) /string|number/.test(typeof e[t]) && e[t] !== "" && n.push(t + '="' + e[t] + '"');
    return n[s]("")
  }, r = function(e) {
    var t, n, r = [],
      i;
    if(typeof e == "object") {
      for(t in e) {
        if(typeof e[t] == "object") {
          i = [];
          for(n in e[t]) i.push([n, "=", encodeURIComponent(e[t][n])][s](""));
          e[t] = i[s]("&amp;")
        }
        e[t] && r.push(['<param name="', t, '" value="', e[t], '" />'][s](""))
      }
      e = r[s]("")
    }
    return e
  }, i = !1,
    s = "join";
  e[t] = function() {
    try {
      var o = "0,0,0",
        u = navigator.plugins["Shockwave Flash"] || ActiveXObject;
      o = u.description || function() {
        try {
          return(new u("ShockwaveFlash.ShockwaveFlash")).GetVariable("$version")
        } catch(e) {}
      }()
    } catch(a) {}
    return o = o.match(/^[A-Za-z\s]*?(\d+)[\.|,](\d+)(?:\s+[d|r]|,)(\d+)/), {
      available: o[1] > 0,
      activeX: u && !u.name,
      version: {
        major: o[1] * 1,
        minor: o[2] * 1,
        release: o[3] * 1
      },
      hasVersion: function(e) {
        var t = this.version,
          n = "major",
          r = "minor",
          i = "release";
        return e = /string|number/.test(typeof e) ? e.toString().split(".") : e || [0, 0, 0], e = [e[n] || e[0] || t[n], e[r] || e[1] || t[r], e[i] || e[2] || t[i]], e[0] < t[n] || e[0] == t[n] && e[1] < t[r] || e[0] == t[n] && e[1] == t[r] && e[2] <= t[i]
      },
      expressInstall: "expressInstall.swf",
      create: function(o) {
        return !e[t].available || i || !typeof o == "object" || !o.swf ? !1 : (o.hasVersion && !e[t].hasVersion(o.hasVersion) ? (o = {
          swf: o.expressInstall || e[t].expressInstall,
          attrs: {
            id: o.id || "SWFObjectExprInst",
            name: o.name,
            height: Math.max(o.height || 137),
            width: Math.max(o.width || 214)
          },
          params: {
            flashvars: {
              MMredirectURL: location.href,
              MMplayerType: e[t].activeX ? "ActiveX" : "PlugIn",
              MMdoctitle: document.title.slice(0, 47) + " - Flash Player Installation"
            }
          }
        }, i = !0) : o = e.extend(!0, {
          attrs: {
            id: o.id,
            name: o.name,
            height: o.height || 180,
            width: o.width || 320
          },
          params: {
            wmode: o.wmode || "opaque",
            flashvars: o.flashvars
          }
        }, o), e[t].activeX ? (o.attrs.classid = o.attrs.classid || "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", o.params.movie = o.params.movie || o.swf) : (o.attrs.type = o.attrs.classid || "application/x-shockwave-flash", o.attrs.data = o.attrs.data || o.swf), ["<object ", n(o.attrs), ">", r(o.params), "</object>"][s](""))
      }
    }
  }(), e.fn[t] = function(n) {
    return typeof n == "object" ? this.each(function() {
      var r = document.createElement(t),
        i = e[t].create(n);
      i && (r.innerHTML = i, r.childNodes[0] && this.appendChild(r.childNodes[0]))
    }) : typeof n == "function" && this.find("object").andSelf().filter("object").each(function() {
      var r = this,
        i = "jsInteractionTimeoutMs";
      r[i] = r[i] || 0, r[i] < 660 && (r.clientWidth || r.clientHeight ? n.call(this) : setTimeout(function() {
        e(r)[t](n)
      }, r[i] + 66))
    }), this
  }
}(jQuery, "flash"),
function(e) {
  function t(e, t, r) {
    return "#" + n(e[0] + r * (t[0] - e[0])) + n(e[1] + r * (t[1] - e[1])) + n(e[2] + r * (t[2] - e[2]))
  }
  function n(e) {
    return e = parseInt(e).toString(16), e.length == 1 ? "0" + e : e
  }
  function r(e) {
    var t, n;
    if(t = /#([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})/.exec(e)) n = [parseInt(t[1], 16), parseInt(t[2], 16), parseInt(t[3], 16)];
    else if(t = /#([0-9a-fA-F])([0-9a-fA-F])([0-9a-fA-F])/.exec(e)) n = [parseInt(t[1], 16) * 17, parseInt(t[2], 16) * 17, parseInt(t[3], 16) * 17];
    else if(t = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(e)) n = [parseInt(t[1]), parseInt(t[2]), parseInt(t[3])];
    return n
  }
  var i = ["color", "backgroundColor", "borderBottomColor", "borderLeftColor", "borderRightColor", "borderTopColor", "outlineColor"];
  e.each(i, function(n, i) {
    e.fx.step[i] = function(n) {
      n.init || (n.a = r(e(n.elem).css(i)), n.end = r(n.end), n.init = !0), n.elem.style[i] = t(n.a, n.end, n.pos)
    }
  }), e.fx.step.borderColor = function(n) {
    n.init || (n.end = r(n.end));
    var s = i.slice(2, 6);
    e.each(s, function(i, s) {
      n.init || (n[s] = {
        a: r(e(n.elem).css(s))
      }), n.elem.style[s] = t(n[s].a, n.end, n.pos)
    }), n.init = !0
  }
}(jQuery),
function(e) {
  var t = {
    preloadImg: !0
  }, n = !1,
    r = function(e) {
      e = e.replace(/^url\((.*)\)/, "$1").replace(/^\"(.*)\"$/, "$1");
      var t = new Image;
      t.src = e.replace(/\.([a-zA-Z]*)$/, "-hover.$1");
      var n = new Image;
      n.src = e.replace(/\.([a-zA-Z]*)$/, "-focus.$1")
    }, i = function(t) {
      var n = e(".jqTransformSelectWrapper ul:visible");
      n.each(function() {
        var n = e(this).parents(".jqTransformSelectWrapper:first").find("select").get(0);
        (!t || !n.oLabel || n.oLabel.get(0) != t.get(0)) && e(this).hide()
      })
    }, s = function(t) {
      e(t.target).parents(".jqTransformSelectWrapper").length === 0 && i(e(t.target))
    }, o = function() {
      e(document).mousedown(s)
    }, u = function(t) {
      var n;
      e(".jqTransformSelectWrapper select", t).each(function() {
        n = this.selectedIndex < 0 ? 0 : this.selectedIndex, e("ul", e(this).parent()).each(function() {
          e("a:eq(" + n + ")", this).click()
        })
      }), e("a.jqTransformCheckbox, a.jqTransformRadio", t).removeClass("jqTransformChecked"), e("input:checkbox, input:radio", t).each(function() {
        this.checked && e("a", e(this).parent()).addClass("jqTransformChecked")
      })
    };
  e.fn.jqTransSelect = function() {
    return this.each(function(t) {
      var n = e(this);
      if(n.hasClass("jqTransformHidden") || n.hasClass("jqTransformIgnore")) return;
      if(n.attr("multiple")) return;
      var r = n.addClass("jqTransformHidden").wrap('<div class="jqTransformSelectWrapper sprite"></div>').parent().css({
        zIndex: 50 - t
      });
      r.prepend('<div><span></span><a href="#" class="jqTransformSelectOpen sprite"></a></div><ul></ul>');
      var s = e("ul", r).css("width", n.width()).hide();
      e("option", this).each(function(t) {
        var n = e(this).html() == "" ? "&nbsp;" : e(this).html(),
          r = e('<li><a href="#" class="' + e(this).attr("class") + '" index="' + t + '">' + n + "</a></li>");
        s.append(r)
      }), s.find("a").click(function() {
        return e("a.selected", r).removeClass("selected"), e(this).addClass("selected"), n[0].selectedIndex != e(this).attr("index") && n[0].onchange && (n[0].selectedIndex = e(this).attr("index"), n[0].onchange()), n[0].selectedIndex = e(this).attr("index"), e("span:eq(0)", r).html(e(this).html()), s.hide(), !1
      }), e("a:eq(" + this.selectedIndex + ")", s).click(), e("span:first", r).click(function() {
        e("a.jqTransformSelectOpen", r).trigger("click")
      });
      var o = e("a.jqTransformSelectOpen", r).click(function() {
        return s.css("display") != "none" ? (s.hide(), !1) : (i(), n.attr("disabled") ? !1 : (s.slideToggle("fast", function() {
          var t = e("a.selected", s).offset().top - s.offset().top;
          s.animate({
            scrollTop: t
          }, "fast")
        }), !1))
      }),
        u = n.outerWidth(),
        a = e("span:first", r),
        f = u > a.innerWidth() ? u + o.outerWidth() : r.width();
      f = parseInt(r.css("width")) < f && parseInt(r.css("width")) != 35 ? parseInt(r.css("width")) : f, r.css("width", f), s.css("width", f - 2), a.css({
        width: u
      }), s.css({
        display: "block",
        visibility: "hidden"
      });
      var l = e("li", s).length * e("li:first", s).height();
      l < s.height() && s.css({
        height: l,
        overflow: "hidden"
      }), s.css({
        display: "none",
        visibility: "visible"
      })
    })
  }, e.fn.jqTransform = function(n) {
    var r = e.extend({}, t, n);
    return this.each(function() {
      var t = e(this);
      if(t.hasClass("jqtransformdone")) return;
      t.addClass("jqtransformdone"), e("select", this).jqTransSelect().length > 0 && o(), t.bind("reset", function() {
        var e = function() {
          u(this)
        };
        window.setTimeout(e, 10)
      })
    })
  }
}(jQuery),
function(e, t) {
  "$:nomunge";

  function N(e) {
    return typeof e == "string"
  }
  function C(e) {
    var t = r.call(arguments, 1);
    return function() {
      return e.apply(this, t.concat(r.call(arguments)))
    }
  }
  function k(e) {
    return e.replace(/^[^#]*#?(.*)$/, "$1")
  }
  function L(e) {
    return e.replace(/(?:^[^?#]*\?([^#]*).*$)?.*/, "$1")
  }
  function A(r, o, a, f, l) {
    var c, h, p, d, g;
    return f !== n ? (p = a.match(r ? /^([^#]*)\#?(.*)$/ : /^([^#?]*)\??([^#]*)(#?.*)/), g = p[3] || "", l === 2 && N(f) ? h = f.replace(r ? S : E, "") : (d = u(p[2]), f = N(f) ? u[r ? m : v](f) : f, h = l === 2 ? f : l === 1 ? e.extend({}, f, d) : e.extend({}, d, f), h = s(h), r && (h = h.replace(x, i))), c = p[1] + (r ? "#" : h || !p[1] ? "?" : "") + h + g) : c = o(a !== n ? a : t[y][b]), c
  }
  function O(e, t, r) {
    return t === n || typeof t == "boolean" ? (r = t, t = s[e ? m : v]()) : t = N(t) ? t.replace(e ? S : E, "") : t, u(t, r)
  }
  function M(t, r, i, o) {
    return !N(i) && typeof i != "object" && (o = i, i = r, r = n), this.each(function() {
      var n = e(this),
        u = r || h()[(this.nodeName || "").toLowerCase()] || "",
        a = u && n.attr(u) || "";
      n.attr(u, s[t](a, i, o))
    })
  }
  var n, r = Array.prototype.slice,
    i = decodeURIComponent,
    s = e.param,
    o, u, a, f = e.bbq = e.bbq || {}, l, c, h, p = e.event.special,
    d = "hashchange",
    v = "querystring",
    m = "fragment",
    g = "elemUrlAttr",
    y = "location",
    b = "href",
    w = "src",
    E = /^.*\?|#.*$/g,
    S = /^.*\#/,
    x, T = {};
  s[v] = C(A, 0, L), s[m] = o = C(A, 1, k), o.noEscape = function(t) {
    t = t || "";
    var n = e.map(t.split(""), encodeURIComponent);
    x = new RegExp(n.join("|"), "g")
  }, o.noEscape(",/"), e.deparam = u = function(t, r) {
    var s = {}, o = {
      "true": !0,
      "false": !1,
      "null": null
    };
    return e.each(t.replace(/\+/g, " ").split("&"), function(t, u) {
      var a = u.split("="),
        f = i(a[0]),
        l, c = s,
        h = 0,
        p = f.split("]["),
        d = p.length - 1;
      /\[/.test(p[0]) && /\]$/.test(p[d]) ? (p[d] = p[d].replace(/\]$/, ""), p = p.shift().split("[").concat(p), d = p.length - 1) : d = 0;
      if(a.length === 2) {
        l = i(a[1]), r && (l = l && !isNaN(l) ? +l : l === "undefined" ? n : o[l] !== n ? o[l] : l);
        if(d) for(; h <= d; h++) f = p[h] === "" ? c.length : p[h], c = c[f] = h < d ? c[f] || (p[h + 1] && isNaN(p[h + 1]) ? {} : []) : l;
        else e.isArray(s[f]) ? s[f].push(l) : s[f] !== n ? s[f] = [s[f], l] : s[f] = l
      } else f && (s[f] = r ? n : "")
    }), s
  }, u[v] = C(O, 0), u[m] = a = C(O, 1), e[g] || (e[g] = function(t) {
    return e.extend(T, t)
  })({
    a: b,
    base: b,
    iframe: w,
    img: w,
    input: w,
    form: "action",
    link: b,
    script: w
  }), h = e[g], e.fn[v] = C(M, v), e.fn[m] = C(M, m), f.pushState = l = function(e, r) {
    N(e) && /^#/.test(e) && r === n && (r = 2);
    var i = e !== n,
      s = o(t[y][b], i ? e : {}, i ? r : 2);
    t[y][b] = s + (/#/.test(s) ? "" : "#")
  }, f.getState = c = function(e, t) {
    return e === n || typeof e == "boolean" ? a(e) : a(t)[e]
  }, f.removeState = function(t) {
    var r = {};
    t !== n && (r = c(), e.each(e.isArray(t) ? t : arguments, function(e, t) {
      delete r[t]
    })), l(r, 2)
  }, p[d] = e.extend(p[d], {
    add: function(t) {
      function i(e) {
        var t = e[m] = o();
        e.getState = function(e, r) {
          return e === n || typeof e == "boolean" ? u(t, e) : u(t, r)[e]
        }, r.apply(this, arguments)
      }
      var r;
      if(e.isFunction(t)) return r = t, i;
      r = t.handler, t.handler = i
    }
  })
}(jQuery, this),
function(e, t, n) {
  "$:nomunge";

  function h(e) {
    return e = e || t[s][u], e.replace(/^[^#]*#?(.*)$/, "$1")
  }
  var r, i = e.event.special,
    s = "location",
    o = "hashchange",
    u = "href",
    a = e.browser,
    f = document.documentMode,
    l = a.msie && (f === n || f < 8),
    c = "on" + o in t && !l;
  e[o + "Delay"] = 100, i[o] = e.extend(i[o], {
    setup: function() {
      if(c) return !1;
      e(r.start)
    },
    teardown: function() {
      if(c) return !1;
      e(r.stop)
    }
  }), r = function() {
    function c() {
      a = f = function(e) {
        return e
      }, l && (i = e('<iframe src="javascript:0"/>').hide().insertAfter("body")[0].contentWindow, f = function() {
        return h(i.document[s][u])
      }, a = function(e, t) {
        if(e !== t) {
          var n = i.document;
          n.open().close(), n[s].hash = "#" + e
        }
      }, a(h()))
    }
    var n = {}, r, i, a, f;
    return n.start = function() {
      if(r) return;
      var n = h();
      a || c(),
      function i() {
        var l = h(),
          c = f(n);
        l !== n ? (a(n = l, c), e(t).trigger(o)) : c !== n && (t[s][u] = t[s][u].replace(/#.*/, "") + "#" + c), r = setTimeout(i, e[o + "Delay"])
      }()
    }, n.stop = function() {
      i || (r && clearTimeout(r), r = 0)
    }, n
  }()
}(jQuery, this),
function(e) {
  function t(t, r, i) {
    var s = this;
    return this.on("click.pjax", t, function(t) {
      i = h(r, i), i.container || (i.container = e(this).attr("data-pjax") || s), n(t, i)
    })
  }
  function n(t, n, r) {
    r = h(n, r);
    var s = t.currentTarget;
    if(s.tagName.toUpperCase() !== "A") throw "$.fn.pjax or $.pjax.click requires an anchor element";
    if(t.which > 1 || t.metaKey || t.ctrlKey || t.shiftKey || t.altKey) return;
    if(location.protocol !== s.protocol || location.host !== s.host) return;
    if(s.hash && s.href.replace(s.hash, "") === location.href.replace(location.hash, "")) return;
    if(s.href === location.href + "#") return;
    var o = {
      url: s.href,
      container: e(s).attr("data-pjax"),
      target: s,
      fragment: null
    };
    i(e.extend({}, o, r)), t.preventDefault()
  }
  function r(t, n, r) {
    r = h(n, r);
    var s = t.currentTarget;
    if(s.tagName.toUpperCase() !== "FORM") throw "$.pjax.submit requires a form element";
    var o = {
      type: s.method,
      url: s.action,
      data: e(s).serializeArray(),
      container: e(s).attr("data-pjax"),
      target: s,
      fragment: null,
      timeout: 0
    };
    i(e.extend({}, o, r)), t.preventDefault()
  }
  function i(t) {
    function u(t, r) {
      var i = e.Event(t, {
        relatedTarget: n
      });
      return s.trigger(i, r), !i.isDefaultPrevented()
    }
    t = e.extend(!0, {}, e.ajaxSettings, i.defaults, t), e.isFunction(t.url) && (t.url = t.url());
    var n = t.target,
      r = c(t.url).hash,
      s = t.context = p(t.container);
    t.data || (t.data = {}), t.data._pjax = s.selector;
    var a;
    t.beforeSend = function(e, n) {
      n.type !== "GET" && (n.timeout = 0), n.timeout > 0 && (a = setTimeout(function() {
        u("pjax:timeout", [e, t]) && e.abort("timeout")
      }, n.timeout), n.timeout = 0), e.setRequestHeader("X-PJAX", "true"), e.setRequestHeader("X-PJAX-Container", s.selector);
      var r;
      if(!u("pjax:beforeSend", [e, n])) return !1;
      t.requestUrl = c(n.url).href
    }, t.complete = function(e, n) {
      a && clearTimeout(a), u("pjax:complete", [e, n, t]), u("pjax:end", [e, t])
    }, t.error = function(e, n, r) {
      var i = v("", e, t),
        s = u("pjax:error", [e, n, r, t]);
      n !== "abort" && s && o(i.url)
    }, t.success = function(n, a, l) {
      var h = v(n, l, t);
      if(!h.contents) {
        o(h.url);
        return
      }
      i.state = {
        id: t.id || f(),
        url: h.url,
        title: h.title,
        container: s.selector,
        fragment: t.fragment,
        timeout: t.timeout
      }, (t.push || t.replace) && window.history.replaceState(i.state, h.title, h.url), h.title && (document.title = h.title), s.html(h.contents), typeof t.scrollTo == "number" && e(window).scrollTop(t.scrollTo), (t.replace || t.push) && window._gaq && _gaq.push(["_trackPageview"]);
      if(r !== "") {
        var p = c(h.url);
        p.hash = r, i.state.url = p.href, window.history.replaceState(i.state, h.title, p.href);
        var d = e(p.hash);
        d.length && e(window).scrollTop(d.offset().top)
      }
      u("pjax:success", [n, a, l, t])
    }, i.state || (i.state = {
      id: f(),
      url: window.location.href,
      title: document.title,
      container: s.selector,
      fragment: t.fragment,
      timeout: t.timeout
    }, window.history.replaceState(i.state, document.title));
    var h = i.xhr;
    h && h.readyState < 4 && (h.onreadystatechange = e.noop, h.abort()), i.options = t;
    var h = i.xhr = e.ajax(t);
    return h.readyState > 0 && (t.push && !t.replace && (b(i.state.id, s.clone().contents()), window.history.pushState(null, "", l(t.requestUrl))), u("pjax:start", [h, t]), u("pjax:send", [h, t])), i.xhr
  }
  function s(t, n) {
    var r = {
      url: window.location.href,
      push: !1,
      replace: !0,
      scrollTo: !1
    };
    return i(e.extend(r, h(t, n)))
  }
  function o(e) {
    window.history.replaceState(null, "", "#"), window.location.replace(e)
  }
  function u(t) {
    var n = t.state;
    if(n && n.container) {
      var r = e(n.container);
      if(r.length) {
        var s = m[n.id];
        if(i.state) {
          var u = i.state.id < n.id ? "forward" : "back";
          w(u, i.state.id, r.clone().contents())
        }
        var a = e.Event("pjax:popstate", {
          state: n,
          direction: u
        });
        r.trigger(a);
        var f = {
          id: n.id,
          url: n.url,
          container: r,
          push: !1,
          fragment: n.fragment,
          timeout: n.timeout,
          scrollTo: !1
        };
        s ? (r.trigger("pjax:start", [null, f]), n.title && (document.title = n.title), r.html(s), i.state = n, r.trigger("pjax:end", [null, f])) : i(f), r[0].offsetHeight
      } else o(location.href)
    }
  }
  function a(t) {
    var n = e.isFunction(t.url) ? t.url() : t.url,
      r = t.type ? t.type.toUpperCase() : "GET",
      i = e("<form>", {
        method: r === "GET" ? "GET" : "POST",
        action: n,
        style: "display:none"
      });
    r !== "GET" && r !== "POST" && i.append(e("<input>", {
      type: "hidden",
      name: "_method",
      value: r.toLowerCase()
    }));
    var s = t.data;
    if(typeof s == "string") e.each(s.split("&"), function(t, n) {
      var r = n.split("=");
      i.append(e("<input>", {
        type: "hidden",
        name: r[0],
        value: r[1]
      }))
    });
    else if(typeof s == "object") for(key in s) i.append(e("<input>", {
      type: "hidden",
      name: key,
      value: s[key]
    }));
    e(document.body).append(i), i.submit()
  }
  function f() {
    return(new Date).getTime()
  }
  function l(e) {
    return e.replace(/\?_pjax=[^&]+&?/, "?").replace(/_pjax=[^&]+&?/, "").replace(/[\?&]$/, "")
  }
  function c(e) {
    var t = document.createElement("a");
    return t.href = e, t
  }
  function h(t, n) {
    return t && n ? n.container = t : e.isPlainObject(t) ? n = t : n = {
      container: t
    }, n.container && (n.container = p(n.container)), n
  }
  function p(t) {
    t = e(t);
    if(!t.length) throw "no pjax container for " + t.selector;
    if(t.selector !== "" && t.context === document) return t;
    if(t.attr("id")) return e("#" + t.attr("id"));
    throw "cant get selector for pjax container!"
  }
  function d(e, t) {
    return e.filter(t).add(e.find(t))
  }
  function v(t, n, r) {
    var i = {};
    i.url = l(n.getResponseHeader("X-PJAX-URL") || r.requestUrl);
    if(/<html/i.test(t)) var s = e(t.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0]),
      o = e(t.match(/<body[^>]*>([\s\S.]*)<\/body>/i)[0]);
    else var s = o = e(t);
    if(o.length === 0) return i;
    i.title = d(s, "title").last().text();
    if(r.fragment) {
      if(r.fragment === "body") var u = o;
      else var u = d(o, r.fragment).first();
      u.length && (i.contents = u.contents(), i.title || (i.title = u.attr("title") || u.data("title")))
    } else /<html/i.test(t) || (i.contents = o);
    return i.contents && (i.contents = i.contents.not("title"), i.contents.find("title").remove()), i.title && (i.title = e.trim(i.title)), i
  }
  function b(e, t) {
    m[e] = t, y.push(e);
    while(g.length) delete m[g.shift()];
    while(y.length > i.defaults.maxCacheLength) delete m[y.shift()]
  }
  function w(e, t, n) {
    var r, i;
    m[t] = n, e === "forward" ? (r = y, i = g) : (r = g, i = y), r.push(t), (t = i.pop()) && delete m[t]
  }
  function E() {
    e.fn.pjax = t, e.pjax = i, e.pjax.enable = e.noop, e.pjax.disable = S, e.pjax.click = n, e.pjax.submit = r, e.pjax.reload = s, e.pjax.defaults = {
      timeout: 650,
      push: !0,
      replace: !1,
      type: "GET",
      dataType: "html",
      scrollTo: 0,
      maxCacheLength: 20
    }, e(window).bind("popstate.pjax", u)
  }
  function S() {
    e.fn.pjax = function() {
      return this
    }, e.pjax = a, e.pjax.enable = E, e.pjax.disable = e.noop, e.pjax.click = e.noop, e.pjax.submit = e.noop, e.pjax.reload = window.location.reload, e(window).unbind("popstate.pjax", u)
  }
  var m = {}, g = [],
    y = [];
  e.inArray("state", e.event.props) < 0 && e.event.props.push("state"), e.support.pjax = window.history && window.history.pushState && window.history.replaceState && !navigator.userAgent.match(/((iPod|iPhone|iPad).+\bOS\s+[1-4]|WebApps\/.+CFNetwork)/), e.support.pjax ? E() : S()
}(jQuery),
function(e, t) {
  var n = function() {
    var t = e._data(document, "events");
    return t && t.click && e.grep(t.click, function(e) {
      return e.namespace === "rails"
    }).length
  };
  n() && e.error("jquery-ujs has already been loaded!");
  var r;
  e.rails = r = {
    linkClickSelector: "a[data-confirm], a[data-method], a[data-remote], a[data-disable-with]",
    inputChangeSelector: "select[data-remote], input[data-remote], textarea[data-remote]",
    formSubmitSelector: "form",
    formInputClickSelector: "form input[type=submit], form input[type=image], form button[type=submit], form button:not([type])",
    disableSelector: "input[data-disable-with], button[data-disable-with], textarea[data-disable-with]",
    enableSelector: "input[data-disable-with]:disabled, button[data-disable-with]:disabled, textarea[data-disable-with]:disabled",
    requiredInputSelector: "input[name][required]:not([disabled]),textarea[name][required]:not([disabled])",
    fileInputSelector: "input:file",
    linkDisableSelector: "a[data-disable-with]",
    CSRFProtection: function(t) {
      var n = e('meta[name="csrf-token"]').attr("content");
      n && t.setRequestHeader("X-CSRF-Token", n)
    },
    fire: function(t, n, r) {
      var i = e.Event(n);
      return t.trigger(i, r), i.result !== !1
    },
    confirm: function(e) {
      return confirm(e)
    },
    ajax: function(t) {
      return e.ajax(t)
    },
    href: function(e) {
      return e.attr("href")
    },
    handleRemote: function(n) {
      var i, s, o, u, a, f, l, c;
      if(r.fire(n, "ajax:before")) {
        u = n.data("cross-domain"), a = u === t ? null : u, f = n.data("with-credentials") || null, l = n.data("type") || e.ajaxSettings && e.ajaxSettings.dataType;
        if(n.is("form")) {
          i = n.attr("method"), s = n.attr("action"), o = n.serializeArray();
          var h = n.data("ujs:submit-button");
          h && (o.push(h), n.data("ujs:submit-button", null))
        } else n.is(r.inputChangeSelector) ? (i = n.data("method"), s = n.data("url"), o = n.serialize(), n.data("params") && (o = o + "&" + n.data("params"))) : (i = n.data("method"), s = r.href(n), o = n.data("params") || null);
        c = {
          type: i || "GET",
          data: o,
          dataType: l,
          beforeSend: function(e, i) {
            return i.dataType === t && e.setRequestHeader("accept", "*/*;q=0.5, " + i.accepts.script), r.fire(n, "ajax:beforeSend", [e, i])
          },
          success: function(e, t, r) {
            n.trigger("ajax:success", [e, t, r])
          },
          complete: function(e, t) {
            n.trigger("ajax:complete", [e, t])
          },
          error: function(e, t, r) {
            n.trigger("ajax:error", [e, t, r])
          },
          xhrFields: {
            withCredentials: f
          },
          crossDomain: a
        }, s && (c.url = s);
        var p = r.ajax(c);
        return n.trigger("ajax:send", p), p
      }
      return !1
    },
    handleMethod: function(n) {
      var i = r.href(n),
        s = n.data("method"),
        o = n.attr("target"),
        u = e("meta[name=csrf-token]").attr("content"),
        a = e("meta[name=csrf-param]").attr("content"),
        f = e('<form method="post" action="' + i + '"></form>'),
        l = '<input name="_method" value="' + s + '" type="hidden" />';
      a !== t && u !== t && (l += '<input name="' + a + '" value="' + u + '" type="hidden" />'), o && f.attr("target", o), f.hide().append(l).appendTo("body"), f.submit()
    },
    disableFormElements: function(t) {
      t.find(r.disableSelector).each(function() {
        var t = e(this),
          n = t.is("button") ? "html" : "val";
        t.data("ujs:enable-with", t[n]()), t[n](t.data("disable-with")), t.prop("disabled", !0)
      })
    },
    enableFormElements: function(t) {
      t.find(r.enableSelector).each(function() {
        var t = e(this),
          n = t.is("button") ? "html" : "val";
        t.data("ujs:enable-with") && t[n](t.data("ujs:enable-with")), t.prop("disabled", !1)
      })
    },
    allowAction: function(e) {
      var t = e.data("confirm"),
        n = !1,
        i;
      return t ? (r.fire(e, "confirm") && (n = r.confirm(t), i = r.fire(e, "confirm:complete", [n])), n && i) : !0
    },
    blankInputs: function(t, n, r) {
      var i = e(),
        s, o, u = n || "input,textarea",
        a = t.find(u);
      return a.each(function() {
        s = e(this), o = s.is(":checkbox,:radio") ? s.is(":checked") : s.val();
        if(!o == !r) {
          if(s.is(":radio") && a.filter('input:radio:checked[name="' + s.attr("name") + '"]').length) return !0;
          i = i.add(s)
        }
      }), i.length ? i : !1
    },
    nonBlankInputs: function(e, t) {
      return r.blankInputs(e, t, !0)
    },
    stopEverything: function(t) {
      return e(t.target).trigger("ujs:everythingStopped"), t.stopImmediatePropagation(), !1
    },
    callFormSubmitBindings: function(n, r) {
      var i = n.data("events"),
        s = !0;
      return i !== t && i.submit !== t && e.each(i.submit, function(e, t) {
        if(typeof t.handler == "function") return s = t.handler(r)
      }), s
    },
    disableElement: function(e) {
      e.data("ujs:enable-with", e.html()), e.html(e.data("disable-with")), e.bind("click.railsDisable", function(e) {
        return r.stopEverything(e)
      })
    },
    enableElement: function(e) {
      e.data("ujs:enable-with") !== t && (e.html(e.data("ujs:enable-with")), e.data("ujs:enable-with", !1)), e.unbind("click.railsDisable")
    }
  }, r.fire(e(document), "rails:attachBindings") && (e.ajaxPrefilter(function(e, t, n) {
    e.crossDomain || r.CSRFProtection(n)
  }), e(document).delegate(r.linkDisableSelector, "ajax:complete", function() {
    r.enableElement(e(this))
  }), e(document).delegate(r.linkClickSelector, "click.rails", function(n) {
    var i = e(this),
      s = i.data("method"),
      o = i.data("params");
    if(!r.allowAction(i)) return r.stopEverything(n);
    i.is(r.linkDisableSelector) && r.disableElement(i);
    if(i.data("remote") !== t) {
      if((n.metaKey || n.ctrlKey) && (!s || s === "GET") && !o) return !0;
      var u = r.handleRemote(i);
      return u === !1 ? r.enableElement(i) : u.error(function() {
        r.enableElement(i)
      }), !1
    }
    if(i.data("method")) return r.handleMethod(i), !1
  }), e(document).delegate(r.inputChangeSelector, "change.rails", function(t) {
    var n = e(this);
    return r.allowAction(n) ? (r.handleRemote(n), !1) : r.stopEverything(t)
  }), e(document).delegate(r.formSubmitSelector, "submit.rails", function(n) {
    var i = e(this),
      s = i.data("remote") !== t,
      o = r.blankInputs(i, r.requiredInputSelector),
      u = r.nonBlankInputs(i, r.fileInputSelector);
    if(!r.allowAction(i)) return r.stopEverything(n);
    if(o && i.attr("novalidate") == t && r.fire(i, "ajax:aborted:required", [o])) return r.stopEverything(n);
    if(s) {
      if(u) {
        setTimeout(function() {
          r.disableFormElements(i)
        }, 13);
        var a = r.fire(i, "ajax:aborted:file", [u]);
        return a || setTimeout(function() {
          r.enableFormElements(i)
        }, 13), a
      }
      return !e.support.submitBubbles && e().jquery < "1.7" && r.callFormSubmitBindings(i, n) === !1 ? r.stopEverything(n) : (r.handleRemote(i), !1)
    }
    setTimeout(function() {
      r.disableFormElements(i)
    }, 13)
  }), e(document).delegate(r.formInputClickSelector, "click.rails", function(t) {
    var n = e(this);
    if(!r.allowAction(n)) return r.stopEverything(t);
    var i = n.attr("name"),
      s = i ? {
        name: i,
        value: n.val()
      } : null;
    n.closest("form").data("ujs:submit-button", s)
  }), e(document).delegate(r.formSubmitSelector, "ajax:beforeSend.rails", function(t) {
    this == t.target && r.disableFormElements(e(this))
  }), e(document).delegate(r.formSubmitSelector, "ajax:complete.rails", function(t) {
    this == t.target && r.enableFormElements(e(this))
  }), e(function() {
    csrf_token = e("meta[name=csrf-token]").attr("content"), csrf_param = e("meta[name=csrf-param]").attr("content"), e('form input[name="' + csrf_param + '"]').val(csrf_token)
  }))
}(jQuery);
var swfobject = function() {
  function C() {
    if(b) return;
    try {
      var e = a.getElementsByTagName("body")[0].appendChild(U("span"));
      e.parentNode.removeChild(e)
    } catch(t) {
      return
    }
    b = !0;
    var n = c.length;
    for(var r = 0; r < n; r++) c[r]()
  }
  function k(e) {
    b ? e() : c[c.length] = e
  }
  function L(t) {
    if(typeof u.addEventListener != e) u.addEventListener("load", t, !1);
    else if(typeof a.addEventListener != e) a.addEventListener("load", t, !1);
    else if(typeof u.attachEvent != e) z(u, "onload", t);
    else if(typeof u.onload == "function") {
      var n = u.onload;
      u.onload = function() {
        n(), t()
      }
    } else u.onload = t
  }
  function A() {
    l ? O() : M()
  }
  function O() {
    var n = a.getElementsByTagName("body")[0],
      r = U(t);
    r.setAttribute("type", i);
    var s = n.appendChild(r);
    if(s) {
      var o = 0;
      (function() {
        if(typeof s.GetVariable != e) {
          var t = s.GetVariable("$version");
          t && (t = t.split(" ")[1].split(","), T.pv = [parseInt(t[0], 10), parseInt(t[1], 10), parseInt(t[2], 10)])
        } else if(o < 10) {
          o++, setTimeout(arguments.callee, 10);
          return
        }
        n.removeChild(r), s = null, M()
      })()
    } else M()
  }
  function M() {
    var t = h.length;
    if(t > 0) for(var n = 0; n < t; n++) {
      var r = h[n].id,
        i = h[n].callbackFn,
        s = {
          success: !1,
          id: r
        };
      if(T.pv[0] > 0) {
        var o = R(r);
        if(o) if(W(h[n].swfVersion) && !(T.wk && T.wk < 312)) V(r, !0), i && (s.success = !0, s.ref = _(r), i(s));
        else if(h[n].expressInstall && D()) {
          var u = {};
          u.data = h[n].expressInstall, u.width = o.getAttribute("width") || "0", u.height = o.getAttribute("height") || "0", o.getAttribute("class") && (u.styleclass = o.getAttribute("class")), o.getAttribute("align") && (u.align = o.getAttribute("align"));
          var a = {}, f = o.getElementsByTagName("param"),
            l = f.length;
          for(var c = 0; c < l; c++) f[c].getAttribute("name").toLowerCase() != "movie" && (a[f[c].getAttribute("name")] = f[c].getAttribute("value"));
          P(u, a, r, i)
        } else H(o), i && i(s)
      } else {
        V(r, !0);
        if(i) {
          var p = _(r);
          p && typeof p.SetVariable != e && (s.success = !0, s.ref = p), i(s)
        }
      }
    }
  }
  function _(n) {
    var r = null,
      i = R(n);
    if(i && i.nodeName == "OBJECT") if(typeof i.SetVariable != e) r = i;
    else {
      var s = i.getElementsByTagName(t)[0];
      s && (r = s)
    }
    return r
  }
  function D() {
    return !w && W("6.0.65") && (T.win || T.mac) && !(T.wk && T.wk < 312)
  }
  function P(t, n, r, i) {
    w = !0, g = i || null, y = {
      success: !1,
      id: r
    };
    var o = R(r);
    if(o) {
      o.nodeName == "OBJECT" ? (v = B(o), m = null) : (v = o, m = r), t.id = s;
      if(typeof t.width == e || !/%$/.test(t.width) && parseInt(t.width, 10) < 310) t.width = "310";
      if(typeof t.height == e || !/%$/.test(t.height) && parseInt(t.height, 10) < 137) t.height = "137";
      a.title = a.title.slice(0, 47) + " - Flash Player Installation";
      var f = T.ie && T.win ? "ActiveX" : "PlugIn",
        l = "MMredirectURL=" + u.location.toString().replace(/&/g, "%26") + "&MMplayerType=" + f + "&MMdoctitle=" + a.title;
      typeof n.flashvars != e ? n.flashvars += "&" + l : n.flashvars = l;
      if(T.ie && T.win && o.readyState != 4) {
        var c = U("div");
        r += "SWFObjectNew", c.setAttribute("id", r), o.parentNode.insertBefore(c, o), o.style.display = "none",
        function() {
          o.readyState == 4 ? o.parentNode.removeChild(o) : setTimeout(arguments.callee, 10)
        }()
      }
      j(t, n, r)
    }
  }
  function H(e) {
    if(T.ie && T.win && e.readyState != 4) {
      var t = U("div");
      e.parentNode.insertBefore(t, e), t.parentNode.replaceChild(B(e), t), e.style.display = "none",
      function() {
        e.readyState == 4 ? e.parentNode.removeChild(e) : setTimeout(arguments.callee, 10)
      }()
    } else e.parentNode.replaceChild(B(e), e)
  }
  function B(e) {
    var n = U("div");
    if(T.win && T.ie) n.innerHTML = e.innerHTML;
    else {
      var r = e.getElementsByTagName(t)[0];
      if(r) {
        var i = r.childNodes;
        if(i) {
          var s = i.length;
          for(var o = 0; o < s; o++)(i[o].nodeType != 1 || i[o].nodeName != "PARAM") && i[o].nodeType != 8 && n.appendChild(i[o].cloneNode(!0))
        }
      }
    }
    return n
  }
  function j(n, r, s) {
    var o, u = R(s);
    if(T.wk && T.wk < 312) return o;
    if(u) {
      typeof n.id == e && (n.id = s);
      if(T.ie && T.win) {
        var a = "";
        for(var f in n) n[f] != Object.prototype[f] && (f.toLowerCase() == "data" ? r.movie = n[f] : f.toLowerCase() == "styleclass" ? a += ' class="' + n[f] + '"' : f.toLowerCase() != "classid" && (a += " " + f + '="' + n[f] + '"'));
        var l = "";
        for(var c in r) r[c] != Object.prototype[c] && (l += '<param name="' + c + '" value="' + r[c] + '" />');
        u.outerHTML = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"' + a + ">" + l + "</object>", p[p.length] = n.id, o = R(n.id)
      } else {
        var h = U(t);
        h.setAttribute("type", i);
        for(var d in n) n[d] != Object.prototype[d] && (d.toLowerCase() == "styleclass" ? h.setAttribute("class", n[d]) : d.toLowerCase() != "classid" && h.setAttribute(d, n[d]));
        for(var v in r) r[v] != Object.prototype[v] && v.toLowerCase() != "movie" && F(h, v, r[v]);
        u.parentNode.replaceChild(h, u), o = h
      }
    }
    return o
  }
  function F(e, t, n) {
    var r = U("param");
    r.setAttribute("name", t), r.setAttribute("value", n), e.appendChild(r)
  }
  function I(e) {
    var t = R(e);
    t && t.nodeName == "OBJECT" && (T.ie && T.win ? (t.style.display = "none", function() {
      t.readyState == 4 ? q(e) : setTimeout(arguments.callee, 10)
    }()) : t.parentNode.removeChild(t))
  }
  function q(e) {
    var t = R(e);
    if(t) {
      for(var n in t) typeof t[n] == "function" && (t[n] = null);
      t.parentNode.removeChild(t)
    }
  }
  function R(e) {
    var t = null;
    try {
      t = a.getElementById(e)
    } catch(n) {}
    return t
  }
  function U(e) {
    return a.createElement(e)
  }
  function z(e, t, n) {
    e.attachEvent(t, n), d[d.length] = [e, t, n]
  }
  function W(e) {
    var t = T.pv,
      n = e.split(".");
    return n[0] = parseInt(n[0], 10), n[1] = parseInt(n[1], 10) || 0, n[2] = parseInt(n[2], 10) || 0, t[0] > n[0] || t[0] == n[0] && t[1] > n[1] || t[0] == n[0] && t[1] == n[1] && t[2] >= n[2] ? !0 : !1
  }
  function X(n, r, i, s) {
    if(T.ie && T.mac) return;
    var o = a.getElementsByTagName("head")[0];
    if(!o) return;
    var u = i && typeof i == "string" ? i : "screen";
    s && (E = null, S = null);
    if(!E || S != u) {
      var f = U("style");
      f.setAttribute("type", "text/css"), f.setAttribute("media", u), E = o.appendChild(f), T.ie && T.win && typeof a.styleSheets != e && a.styleSheets.length > 0 && (E = a.styleSheets[a.styleSheets.length - 1]), S = u
    }
    T.ie && T.win ? E && typeof E.addRule == t && E.addRule(n, r) : E && typeof a.createTextNode != e && E.appendChild(a.createTextNode(n + " {" + r + "}"))
  }
  function V(e, t) {
    if(!x) return;
    var n = t ? "visible" : "hidden";
    b && R(e) ? R(e).style.visibility = n : X("#" + e, "visibility:" + n)
  }
  function $(t) {
    var n = /[\\\"<>\.;]/,
      r = n.exec(t) != null;
    return r && typeof encodeURIComponent != e ? encodeURIComponent(t) : t
  }
  var e = "undefined",
    t = "object",
    n = "Shockwave Flash",
    r = "ShockwaveFlash.ShockwaveFlash",
    i = "application/x-shockwave-flash",
    s = "SWFObjectExprInst",
    o = "onreadystatechange",
    u = window,
    a = document,
    f = navigator,
    l = !1,
    c = [A],
    h = [],
    p = [],
    d = [],
    v, m, g, y, b = !1,
    w = !1,
    E, S, x = !0,
    T = function() {
      var s = typeof a.getElementById != e && typeof a.getElementsByTagName != e && typeof a.createElement != e,
        o = f.userAgent.toLowerCase(),
        c = f.platform.toLowerCase(),
        h = c ? /win/.test(c) : /win/.test(o),
        p = c ? /mac/.test(c) : /mac/.test(o),
        d = /webkit/.test(o) ? parseFloat(o.replace(/^.*webkit\/(\d+(\.\d+)?).*$/, "$1")) : !1,
        v = !1,
        m = [0, 0, 0],
        g = null;
      if(typeof f.plugins != e && typeof f.plugins[n] == t) g = f.plugins[n].description, g && (typeof f.mimeTypes == e || !f.mimeTypes[i] || !! f.mimeTypes[i].enabledPlugin) && (l = !0, v = !1, g = g.replace(/^.*\s+(\S+\s+\S+$)/, "$1"), m[0] = parseInt(g.replace(/^(.*)\..*$/, "$1"), 10), m[1] = parseInt(g.replace(/^.*\.(.*)\s.*$/, "$1"), 10), m[2] = /[a-zA-Z]/.test(g) ? parseInt(g.replace(/^.*[a-zA-Z]+(.*)$/, "$1"), 10) : 0);
      else if(typeof u.ActiveXObject != e) try {
        var y = new ActiveXObject(r);
        y && (g = y.GetVariable("$version"), g && (v = !0, g = g.split(" ")[1].split(","), m = [parseInt(g[0], 10), parseInt(g[1], 10), parseInt(g[2], 10)]))
      } catch(b) {}
      return {
        w3: s,
        pv: m,
        wk: d,
        ie: v,
        win: h,
        mac: p
      }
    }(),
    N = function() {
      if(!T.w3) return;
      (typeof a.readyState != e && a.readyState == "complete" || typeof a.readyState == e && (a.getElementsByTagName("body")[0] || a.body)) && C(), b || (typeof a.addEventListener != e && a.addEventListener("DOMContentLoaded", C, !1), T.ie && T.win && (a.attachEvent(o, function() {
        a.readyState == "complete" && (a.detachEvent(o, arguments.callee), C())
      }), u == top && function() {
        if(b) return;
        try {
          a.documentElement.doScroll("left")
        } catch(e) {
          setTimeout(arguments.callee, 0);
          return
        }
        C()
      }()), T.wk && function() {
        if(b) return;
        if(!/loaded|complete/.test(a.readyState)) {
          setTimeout(arguments.callee, 0);
          return
        }
        C()
      }(), L(C))
    }(),
    J = function() {
      T.ie && T.win && window.attachEvent("onunload", function() {
        var e = d.length;
        for(var t = 0; t < e; t++) d[t][0].detachEvent(d[t][1], d[t][2]);
        var n = p.length;
        for(var r = 0; r < n; r++) I(p[r]);
        for(var i in T) T[i] = null;
        T = null;
        for(var s in swfobject) swfobject[s] = null;
        swfobject = null
      })
    }();
  return {
    registerObject: function(e, t, n, r) {
      if(T.w3 && e && t) {
        var i = {};
        i.id = e, i.swfVersion = t, i.expressInstall = n, i.callbackFn = r, h[h.length] = i, V(e, !1)
      } else r && r({
        success: !1,
        id: e
      })
    },
    getObjectById: function(e) {
      if(T.w3) return _(e)
    },
    embedSWF: function(n, r, i, s, o, u, a, f, l, c) {
      var h = {
        success: !1,
        id: r
      };
      T.w3 && !(T.wk && T.wk < 312) && n && r && i && s && o ? (V(r, !1), k(function() {
        i += "", s += "";
        var p = {};
        if(l && typeof l === t) for(var d in l) p[d] = l[d];
        p.data = n, p.width = i, p.height = s;
        var v = {};
        if(f && typeof f === t) for(var m in f) v[m] = f[m];
        if(a && typeof a === t) for(var g in a) typeof v.flashvars != e ? v.flashvars += "&" + g + "=" + a[g] : v.flashvars = g + "=" + a[g];
        if(W(o)) {
          var y = j(p, v, r);
          p.id == r && V(r, !0), h.success = !0, h.ref = y
        } else {
          if(u && D()) {
            p.data = u, P(p, v, r, c);
            return
          }
          V(r, !0)
        }
        c && c(h)
      })) : c && c(h)
    },
    switchOffAutoHideShow: function() {
      x = !1
    },
    ua: T,
    getFlashPlayerVersion: function() {
      return {
        major: T.pv[0],
        minor: T.pv[1],
        release: T.pv[2]
      }
    },
    hasFlashPlayerVersion: W,
    createSWF: function(e, t, n) {
      return T.w3 ? j(e, t, n) : undefined
    },
    showExpressInstall: function(e, t, n, r) {
      T.w3 && D() && P(e, t, n, r)
    },
    removeSWF: function(e) {
      T.w3 && I(e)
    },
    createCSS: function(e, t, n, r) {
      T.w3 && X(e, t, n, r)
    },
    addDomLoadEvent: k,
    addLoadEvent: L,
    getQueryParamValue: function(e) {
      var t = a.location.search || a.location.hash;
      if(t) {
        /\?/.test(t) && (t = t.split("?")[1]);
        if(e == null) return $(t);
        var n = t.split("&");
        for(var r = 0; r < n.length; r++) if(n[r].substring(0, n[r].indexOf("=")) == e) return $(n[r].substring(n[r].indexOf("=") + 1))
      }
      return ""
    },
    expressInstallCallback: function() {
      if(w) {
        var e = R(s);
        e && v && (e.parentNode.replaceChild(v, e), m && (V(m, !0), T.ie && T.win && (v.style.display = "block")), g && g(y)), w = !1
      }
    }
  }
}();
(function() {
  function C(e, t, n) {
    if(e === t) return e !== 0 || 1 / e == 1 / t;
    if(e == null || t == null) return e === t;
    e._chain && (e = e._wrapped), t._chain && (t = t._wrapped);
    if(e.isEqual && S.isFunction(e.isEqual)) return e.isEqual(t);
    if(t.isEqual && S.isFunction(t.isEqual)) return t.isEqual(e);
    var r = a.call(e);
    if(r != a.call(t)) return !1;
    switch(r) {
    case "[object String]":
      return e == String(t);
    case "[object Number]":
      return e != +e ? t != +t : e == 0 ? 1 / e == 1 / t : e == +t;
    case "[object Date]":
    case "[object Boolean]":
      return +e == +t;
    case "[object RegExp]":
      return e.source == t.source && e.global == t.global && e.multiline == t.multiline && e.ignoreCase == t.ignoreCase
    }
    if(typeof e != "object" || typeof t != "object") return !1;
    var i = n.length;
    while(i--) if(n[i] == e) return !0;
    n.push(e);
    var s = 0,
      o = !0;
    if(r == "[object Array]") {
      s = e.length, o = s == t.length;
      if(o) while(s--) if(!(o = s in e == s in t && C(e[s], t[s], n))) break
    } else {
      if("constructor" in e != "constructor" in t || e.constructor != t.constructor) return !1;
      for(var u in e) if(S.has(e, u)) {
        s++;
        if(!(o = S.has(t, u) && C(e[u], t[u], n))) break
      }
      if(o) {
        for(u in t) if(S.has(t, u) && !(s--)) break;
        o = !s
      }
    }
    return n.pop(), o
  }
  var e = this,
    t = e._,
    n = {}, r = Array.prototype,
    i = Object.prototype,
    s = Function.prototype,
    o = r.slice,
    u = r.unshift,
    a = i.toString,
    f = i.hasOwnProperty,
    l = r.forEach,
    c = r.map,
    h = r.reduce,
    p = r.reduceRight,
    d = r.filter,
    v = r.every,
    m = r.some,
    g = r.indexOf,
    y = r.lastIndexOf,
    b = Array.isArray,
    w = Object.keys,
    E = s.bind,
    S = function(e) {
      return new P(e)
    };
  typeof exports != "undefined" ? (typeof module != "undefined" && module.exports && (exports = module.exports = S), exports._ = S) : e._ = S, S.VERSION = "1.3.3";
  var x = S.each = S.forEach = function(e, t, r) {
    if(e == null) return;
    if(l && e.forEach === l) e.forEach(t, r);
    else if(e.length === +e.length) {
      for(var i = 0, s = e.length; i < s; i++) if(i in e && t.call(r, e[i], i, e) === n) return
    } else for(var o in e) if(S.has(e, o) && t.call(r, e[o], o, e) === n) return
  };
  S.map = S.collect = function(e, t, n) {
    var r = [];
    return e == null ? r : c && e.map === c ? e.map(t, n) : (x(e, function(e, i, s) {
      r[r.length] = t.call(n, e, i, s)
    }), e.length === +e.length && (r.length = e.length), r)
  }, S.reduce = S.foldl = S.inject = function(e, t, n, r) {
    var i = arguments.length > 2;
    e == null && (e = []);
    if(h && e.reduce === h) return r && (t = S.bind(t, r)), i ? e.reduce(t, n) : e.reduce(t);
    x(e, function(e, s, o) {
      i ? n = t.call(r, n, e, s, o) : (n = e, i = !0)
    });
    if(!i) throw new TypeError("Reduce of empty array with no initial value");
    return n
  }, S.reduceRight = S.foldr = function(e, t, n, r) {
    var i = arguments.length > 2;
    e == null && (e = []);
    if(p && e.reduceRight === p) return r && (t = S.bind(t, r)), i ? e.reduceRight(t, n) : e.reduceRight(t);
    var s = S.toArray(e).reverse();
    return r && !i && (t = S.bind(t, r)), i ? S.reduce(s, t, n, r) : S.reduce(s, t)
  }, S.find = S.detect = function(e, t, n) {
    var r;
    return T(e, function(e, i, s) {
      if(t.call(n, e, i, s)) return r = e, !0
    }), r
  }, S.filter = S.select = function(e, t, n) {
    var r = [];
    return e == null ? r : d && e.filter === d ? e.filter(t, n) : (x(e, function(e, i, s) {
      t.call(n, e, i, s) && (r[r.length] = e)
    }), r)
  }, S.reject = function(e, t, n) {
    var r = [];
    return e == null ? r : (x(e, function(e, i, s) {
      t.call(n, e, i, s) || (r[r.length] = e)
    }), r)
  }, S.every = S.all = function(e, t, r) {
    var i = !0;
    return e == null ? i : v && e.every === v ? e.every(t, r) : (x(e, function(e, s, o) {
      if(!(i = i && t.call(r, e, s, o))) return n
    }), !! i)
  };
  var T = S.some = S.any = function(e, t, r) {
    t || (t = S.identity);
    var i = !1;
    return e == null ? i : m && e.some === m ? e.some(t, r) : (x(e, function(e, s, o) {
      if(i || (i = t.call(r, e, s, o))) return n
    }), !! i)
  };
  S.include = S.contains = function(e, t) {
    var n = !1;
    return e == null ? n : g && e.indexOf === g ? e.indexOf(t) != -1 : (n = T(e, function(e) {
      return e === t
    }), n)
  }, S.invoke = function(e, t) {
    var n = o.call(arguments, 2);
    return S.map(e, function(e) {
      return(S.isFunction(t) ? t || e : e[t]).apply(e, n)
    })
  }, S.pluck = function(e, t) {
    return S.map(e, function(e) {
      return e[t]
    })
  }, S.max = function(e, t, n) {
    if(!t && S.isArray(e) && e[0] === +e[0]) return Math.max.apply(Math, e);
    if(!t && S.isEmpty(e)) return -Infinity;
    var r = {
      computed: -Infinity
    };
    return x(e, function(e, i, s) {
      var o = t ? t.call(n, e, i, s) : e;
      o >= r.computed && (r = {
        value: e,
        computed: o
      })
    }), r.value
  }, S.min = function(e, t, n) {
    if(!t && S.isArray(e) && e[0] === +e[0]) return Math.min.apply(Math, e);
    if(!t && S.isEmpty(e)) return Infinity;
    var r = {
      computed: Infinity
    };
    return x(e, function(e, i, s) {
      var o = t ? t.call(n, e, i, s) : e;
      o < r.computed && (r = {
        value: e,
        computed: o
      })
    }), r.value
  }, S.shuffle = function(e) {
    var t = [],
      n;
    return x(e, function(e, r, i) {
      n = Math.floor(Math.random() * (r + 1)), t[r] = t[n], t[n] = e
    }), t
  }, S.sortBy = function(e, t, n) {
    var r = S.isFunction(t) ? t : function(e) {
        return e[t]
      };
    return S.pluck(S.map(e, function(e, t, i) {
      return {
        value: e,
        criteria: r.call(n, e, t, i)
      }
    }).sort(function(e, t) {
      var n = e.criteria,
        r = t.criteria;
      return n === void 0 ? 1 : r === void 0 ? -1 : n < r ? -1 : n > r ? 1 : 0
    }), "value")
  }, S.groupBy = function(e, t) {
    var n = {}, r = S.isFunction(t) ? t : function(e) {
        return e[t]
      };
    return x(e, function(e, t) {
      var i = r(e, t);
      (n[i] || (n[i] = [])).push(e)
    }), n
  }, S.sortedIndex = function(e, t, n) {
    n || (n = S.identity);
    var r = 0,
      i = e.length;
    while(r < i) {
      var s = r + i >> 1;
      n(e[s]) < n(t) ? r = s + 1 : i = s
    }
    return r
  }, S.toArray = function(e) {
    return e ? S.isArray(e) ? o.call(e) : S.isArguments(e) ? o.call(e) : e.toArray && S.isFunction(e.toArray) ? e.toArray() : S.values(e) : []
  }, S.size = function(e) {
    return S.isArray(e) ? e.length : S.keys(e).length
  }, S.first = S.head = S.take = function(e, t, n) {
    return t != null && !n ? o.call(e, 0, t) : e[0]
  }, S.initial = function(e, t, n) {
    return o.call(e, 0, e.length - (t == null || n ? 1 : t))
  }, S.last = function(e, t, n) {
    return t != null && !n ? o.call(e, Math.max(e.length - t, 0)) : e[e.length - 1]
  }, S.rest = S.tail = function(e, t, n) {
    return o.call(e, t == null || n ? 1 : t)
  }, S.compact = function(e) {
    return S.filter(e, function(e) {
      return !!e
    })
  }, S.flatten = function(e, t) {
    return S.reduce(e, function(e, n) {
      return S.isArray(n) ? e.concat(t ? n : S.flatten(n)) : (e[e.length] = n, e)
    }, [])
  }, S.without = function(e) {
    return S.difference(e, o.call(arguments, 1))
  }, S.uniq = S.unique = function(e, t, n) {
    var r = n ? S.map(e, n) : e,
      i = [];
    return e.length < 3 && (t = !0), S.reduce(r, function(n, r, s) {
      if(t ? S.last(n) !== r || !n.length : !S.include(n, r)) n.push(r), i.push(e[s]);
      return n
    }, []), i
  }, S.union = function() {
    return S.uniq(S.flatten(arguments, !0))
  }, S.intersection = S.intersect = function(e) {
    var t = o.call(arguments, 1);
    return S.filter(S.uniq(e), function(e) {
      return S.every(t, function(t) {
        return S.indexOf(t, e) >= 0
      })
    })
  }, S.difference = function(e) {
    var t = S.flatten(o.call(arguments, 1), !0);
    return S.filter(e, function(e) {
      return !S.include(t, e)
    })
  }, S.zip = function() {
    var e = o.call(arguments),
      t = S.max(S.pluck(e, "length")),
      n = new Array(t);
    for(var r = 0; r < t; r++) n[r] = S.pluck(e, "" + r);
    return n
  }, S.indexOf = function(e, t, n) {
    if(e == null) return -1;
    var r, i;
    if(n) return r = S.sortedIndex(e, t), e[r] === t ? r : -1;
    if(g && e.indexOf === g) return e.indexOf(t);
    for(r = 0, i = e.length; r < i; r++) if(r in e && e[r] === t) return r;
    return -1
  }, S.lastIndexOf = function(e, t) {
    if(e == null) return -1;
    if(y && e.lastIndexOf === y) return e.lastIndexOf(t);
    var n = e.length;
    while(n--) if(n in e && e[n] === t) return n;
    return -1
  }, S.range = function(e, t, n) {
    arguments.length <= 1 && (t = e || 0, e = 0), n = arguments[2] || 1;
    var r = Math.max(Math.ceil((t - e) / n), 0),
      i = 0,
      s = new Array(r);
    while(i < r) s[i++] = e, e += n;
    return s
  };
  var N = function() {};
  S.bind = function(t, n) {
    var r, i;
    if(t.bind === E && E) return E.apply(t, o.call(arguments, 1));
    if(!S.isFunction(t)) throw new TypeError;
    return i = o.call(arguments, 2), r = function() {
      if(this instanceof r) {
        N.prototype = t.prototype;
        var e = new N,
          s = t.apply(e, i.concat(o.call(arguments)));
        return Object(s) === s ? s : e
      }
      return t.apply(n, i.concat(o.call(arguments)))
    }
  }, S.bindAll = function(e) {
    var t = o.call(arguments, 1);
    return t.length == 0 && (t = S.functions(e)), x(t, function(t) {
      e[t] = S.bind(e[t], e)
    }), e
  }, S.memoize = function(e, t) {
    var n = {};
    return t || (t = S.identity),
    function() {
      var r = t.apply(this, arguments);
      return S.has(n, r) ? n[r] : n[r] = e.apply(this, arguments)
    }
  }, S.delay = function(e, t) {
    var n = o.call(arguments, 2);
    return setTimeout(function() {
      return e.apply(null, n)
    }, t)
  }, S.defer = function(e) {
    return S.delay.apply(S, [e, 1].concat(o.call(arguments, 1)))
  }, S.throttle = function(e, t) {
    var n, r, i, s, o, u, a = S.debounce(function() {
      o = s = !1
    }, t);
    return function() {
      n = this, r = arguments;
      var f = function() {
        i = null, o && e.apply(n, r), a()
      };
      return i || (i = setTimeout(f, t)), s ? o = !0 : u = e.apply(n, r), a(), s = !0, u
    }
  }, S.debounce = function(e, t, n) {
    var r;
    return function() {
      var i = this,
        s = arguments,
        o = function() {
          r = null, n || e.apply(i, s)
        };
      n && !r && e.apply(i, s), clearTimeout(r), r = setTimeout(o, t)
    }
  }, S.once = function(e) {
    var t = !1,
      n;
    return function() {
      return t ? n : (t = !0, n = e.apply(this, arguments))
    }
  }, S.wrap = function(e, t) {
    return function() {
      var n = [e].concat(o.call(arguments, 0));
      return t.apply(this, n)
    }
  }, S.compose = function() {
    var e = arguments;
    return function() {
      var t = arguments;
      for(var n = e.length - 1; n >= 0; n--) t = [e[n].apply(this, t)];
      return t[0]
    }
  }, S.after = function(e, t) {
    return e <= 0 ? t() : function() {
      if(--e < 1) return t.apply(this, arguments)
    }
  }, S.keys = w || function(e) {
    if(e !== Object(e)) throw new TypeError("Invalid object");
    var t = [];
    for(var n in e) S.has(e, n) && (t[t.length] = n);
    return t
  }, S.values = function(e) {
    return S.map(e, S.identity)
  }, S.functions = S.methods = function(e) {
    var t = [];
    for(var n in e) S.isFunction(e[n]) && t.push(n);
    return t.sort()
  }, S.extend = function(e) {
    return x(o.call(arguments, 1), function(t) {
      for(var n in t) e[n] = t[n]
    }), e
  }, S.pick = function(e) {
    var t = {};
    return x(S.flatten(o.call(arguments, 1)), function(n) {
      n in e && (t[n] = e[n])
    }), t
  }, S.defaults = function(e) {
    return x(o.call(arguments, 1), function(t) {
      for(var n in t) e[n] == null && (e[n] = t[n])
    }), e
  }, S.clone = function(e) {
    return S.isObject(e) ? S.isArray(e) ? e.slice() : S.extend({}, e) : e
  }, S.tap = function(e, t) {
    return t(e), e
  }, S.isEqual = function(e, t) {
    return C(e, t, [])
  }, S.isEmpty = function(e) {
    if(e == null) return !0;
    if(S.isArray(e) || S.isString(e)) return e.length === 0;
    for(var t in e) if(S.has(e, t)) return !1;
    return !0
  }, S.isElement = function(e) {
    return !!e && e.nodeType == 1
  }, S.isArray = b || function(e) {
    return a.call(e) == "[object Array]"
  }, S.isObject = function(e) {
    return e === Object(e)
  }, S.isArguments = function(e) {
    return a.call(e) == "[object Arguments]"
  }, S.isArguments(arguments) || (S.isArguments = function(e) {
    return !!e && !! S.has(e, "callee")
  }), S.isFunction = function(e) {
    return a.call(e) == "[object Function]"
  }, S.isString = function(e) {
    return a.call(e) == "[object String]"
  }, S.isNumber = function(e) {
    return a.call(e) == "[object Number]"
  }, S.isFinite = function(e) {
    return S.isNumber(e) && isFinite(e)
  }, S.isNaN = function(e) {
    return e !== e
  }, S.isBoolean = function(e) {
    return e === !0 || e === !1 || a.call(e) == "[object Boolean]"
  }, S.isDate = function(e) {
    return a.call(e) == "[object Date]"
  }, S.isRegExp = function(e) {
    return a.call(e) == "[object RegExp]"
  }, S.isNull = function(e) {
    return e === null
  }, S.isUndefined = function(e) {
    return e === void 0
  }, S.has = function(e, t) {
    return f.call(e, t)
  }, S.noConflict = function() {
    return e._ = t, this
  }, S.identity = function(e) {
    return e
  }, S.times = function(e, t, n) {
    for(var r = 0; r < e; r++) t.call(n, r)
  }, S.escape = function(e) {
    return("" + e).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#x27;").replace(/\//g, "&#x2F;")
  }, S.result = function(e, t) {
    if(e == null) return null;
    var n = e[t];
    return S.isFunction(n) ? n.call(e) : n
  }, S.mixin = function(e) {
    x(S.functions(e), function(t) {
      B(t, S[t] = e[t])
    })
  };
  var k = 0;
  S.uniqueId = function(e) {
    var t = k++;
    return e ? e + t : t
  }, S.templateSettings = {
    evaluate: /<%([\s\S]+?)%>/g,
    interpolate: /<%=([\s\S]+?)%>/g,
    escape: /<%-([\s\S]+?)%>/g
  };
  var L = /.^/,
    A = {
      "\\": "\\",
      "'": "'",
      r: "\r",
      n: "\n",
      t: "	",
      u2028: "\u2028",
      u2029: "\u2029"
    };
  for(var O in A) A[A[O]] = O;
  var M = /\\|'|\r|\n|\t|\u2028|\u2029/g,
    _ = /\\(\\|'|r|n|t|u2028|u2029)/g,
    D = function(e) {
      return e.replace(_, function(e, t) {
        return A[t]
      })
    };
  S.template = function(e, t, n) {
    n = S.defaults(n || {}, S.templateSettings);
    var r = "__p+='" + e.replace(M, function(e) {
      return "\\" + A[e]
    }).replace(n.escape || L, function(e, t) {
      return "'+\n_.escape(" + D(t) + ")+\n'"
    }).replace(n.interpolate || L, function(e, t) {
      return "'+\n(" + D(t) + ")+\n'"
    }).replace(n.evaluate || L, function(e, t) {
      return "';\n" + D(t) + "\n;__p+='"
    }) + "';\n";
    n.variable || (r = "with(obj||{}){\n" + r + "}\n"), r = "var __p='';var print=function(){__p+=Array.prototype.join.call(arguments, '')};\n" + r + "return __p;\n";
    var i = new Function(n.variable || "obj", "_", r);
    if(t) return i(t, S);
    var s = function(e) {
      return i.call(this, e, S)
    };
    return s.source = "function(" + (n.variable || "obj") + "){\n" + r + "}", s
  }, S.chain = function(e) {
    return S(e).chain()
  };
  var P = function(e) {
    this._wrapped = e
  };
  S.prototype = P.prototype;
  var H = function(e, t) {
    return t ? S(e).chain() : e
  }, B = function(e, t) {
    P.prototype[e] = function() {
      var e = o.call(arguments);
      return u.call(e, this._wrapped), H(t.apply(S, e), this._chain)
    }
  };
  S.mixin(S), x(["pop", "push", "reverse", "shift", "sort", "splice", "unshift"], function(e) {
    var t = r[e];
    P.prototype[e] = function() {
      var n = this._wrapped;
      t.apply(n, arguments);
      var r = n.length;
      return(e == "shift" || e == "splice") && r === 0 && delete n[0], H(n, this._chain)
    }
  }), x(["concat", "join", "slice"], function(e) {
    var t = r[e];
    P.prototype[e] = function() {
      return H(t.apply(this._wrapped, arguments), this._chain)
    }
  }), P.prototype.chain = function() {
    return this._chain = !0, this
  }, P.prototype.value = function() {
    return this._wrapped
  }
}).call(this);
var Handlebars = {};
Handlebars.VERSION = "1.0.beta.6", Handlebars.helpers = {}, Handlebars.partials = {}, Handlebars.registerHelper = function(e, t, n) {
  n && (t.not = n), this.helpers[e] = t
}, Handlebars.registerPartial = function(e, t) {
  this.partials[e] = t
}, Handlebars.registerHelper("helperMissing", function(e) {
  if(arguments.length === 2) return undefined;
  throw new Error("Could not find property '" + e + "'")
});
var toString = Object.prototype.toString,
  functionType = "[object Function]";
Handlebars.registerHelper("blockHelperMissing", function(e, t) {
  var n = t.inverse || function() {}, r = t.fn,
    i = "",
    s = toString.call(e);
  s === functionType && (e = e.call(this));
  if(e === !0) return r(this);
  if(e === !1 || e == null) return n(this);
  if(s === "[object Array]") {
    if(e.length > 0) for(var o = 0, u = e.length; o < u; o++) i += r(e[o]);
    else i = n(this);
    return i
  }
  return r(e)
}), Handlebars.registerHelper("each", function(e, t) {
  var n = t.fn,
    r = t.inverse,
    i = "";
  if(e && e.length > 0) for(var s = 0, o = e.length; s < o; s++) i += n(e[s]);
  else i = r(this);
  return i
}), Handlebars.registerHelper("if", function(e, t) {
  var n = toString.call(e);
  return n === functionType && (e = e.call(this)), !e || Handlebars.Utils.isEmpty(e) ? t.inverse(this) : t.fn(this)
}), Handlebars.registerHelper("unless", function(e, t) {
  var n = t.fn,
    r = t.inverse;
  return t.fn = r, t.inverse = n, Handlebars.helpers["if"].call(this, e, t)
}), Handlebars.registerHelper("with", function(e, t) {
  return t.fn(e)
}), Handlebars.registerHelper("log", function(e) {
  Handlebars.log(e)
});
var handlebars = function() {
  var e = {
    trace: function() {},
    yy: {},
    symbols_: {
      error: 2,
      root: 3,
      program: 4,
      EOF: 5,
      statements: 6,
      simpleInverse: 7,
      statement: 8,
      openInverse: 9,
      closeBlock: 10,
      openBlock: 11,
      mustache: 12,
      partial: 13,
      CONTENT: 14,
      COMMENT: 15,
      OPEN_BLOCK: 16,
      inMustache: 17,
      CLOSE: 18,
      OPEN_INVERSE: 19,
      OPEN_ENDBLOCK: 20,
      path: 21,
      OPEN: 22,
      OPEN_UNESCAPED: 23,
      OPEN_PARTIAL: 24,
      params: 25,
      hash: 26,
      param: 27,
      STRING: 28,
      INTEGER: 29,
      BOOLEAN: 30,
      hashSegments: 31,
      hashSegment: 32,
      ID: 33,
      EQUALS: 34,
      pathSegments: 35,
      SEP: 36,
      $accept: 0,
      $end: 1
    },
    terminals_: {
      2: "error",
      5: "EOF",
      14: "CONTENT",
      15: "COMMENT",
      16: "OPEN_BLOCK",
      18: "CLOSE",
      19: "OPEN_INVERSE",
      20: "OPEN_ENDBLOCK",
      22: "OPEN",
      23: "OPEN_UNESCAPED",
      24: "OPEN_PARTIAL",
      28: "STRING",
      29: "INTEGER",
      30: "BOOLEAN",
      33: "ID",
      34: "EQUALS",
      36: "SEP"
    },
    productions_: [0, [3, 2],
      [4, 3],
      [4, 1],
      [4, 0],
      [6, 1],
      [6, 2],
      [8, 3],
      [8, 3],
      [8, 1],
      [8, 1],
      [8, 1],
      [8, 1],
      [11, 3],
      [9, 3],
      [10, 3],
      [12, 3],
      [12, 3],
      [13, 3],
      [13, 4],
      [7, 2],
      [17, 3],
      [17, 2],
      [17, 2],
      [17, 1],
      [25, 2],
      [25, 1],
      [27, 1],
      [27, 1],
      [27, 1],
      [27, 1],
      [26, 1],
      [31, 2],
      [31, 1],
      [32, 3],
      [32, 3],
      [32, 3],
      [32, 3],
      [21, 1],
      [35, 3],
      [35, 1]
    ],
    performAction: function(t, n, r, i, s, o, u) {
      var a = o.length - 1;
      switch(s) {
      case 1:
        return o[a - 1];
      case 2:
        this.$ = new i.ProgramNode(o[a - 2], o[a]);
        break;
      case 3:
        this.$ = new i.ProgramNode(o[a]);
        break;
      case 4:
        this.$ = new i.ProgramNode([]);
        break;
      case 5:
        this.$ = [o[a]];
        break;
      case 6:
        o[a - 1].push(o[a]), this.$ = o[a - 1];
        break;
      case 7:
        this.$ = new i.InverseNode(o[a - 2], o[a - 1], o[a]);
        break;
      case 8:
        this.$ = new i.BlockNode(o[a - 2], o[a - 1], o[a]);
        break;
      case 9:
        this.$ = o[a];
        break;
      case 10:
        this.$ = o[a];
        break;
      case 11:
        this.$ = new i.ContentNode(o[a]);
        break;
      case 12:
        this.$ = new i.CommentNode(o[a]);
        break;
      case 13:
        this.$ = new i.MustacheNode(o[a - 1][0], o[a - 1][1]);
        break;
      case 14:
        this.$ = new i.MustacheNode(o[a - 1][0], o[a - 1][1]);
        break;
      case 15:
        this.$ = o[a - 1];
        break;
      case 16:
        this.$ = new i.MustacheNode(o[a - 1][0], o[a - 1][1]);
        break;
      case 17:
        this.$ = new i.MustacheNode(o[a - 1][0], o[a - 1][1], !0);
        break;
      case 18:
        this.$ = new i.PartialNode(o[a - 1]);
        break;
      case 19:
        this.$ = new i.PartialNode(o[a - 2], o[a - 1]);
        break;
      case 20:
        break;
      case 21:
        this.$ = [
          [o[a - 2]].concat(o[a - 1]), o[a]
        ];
        break;
      case 22:
        this.$ = [
          [o[a - 1]].concat(o[a]), null];
        break;
      case 23:
        this.$ = [
          [o[a - 1]], o[a]
        ];
        break;
      case 24:
        this.$ = [
          [o[a]], null];
        break;
      case 25:
        o[a - 1].push(o[a]), this.$ = o[a - 1];
        break;
      case 26:
        this.$ = [o[a]];
        break;
      case 27:
        this.$ = o[a];
        break;
      case 28:
        this.$ = new i.StringNode(o[a]);
        break;
      case 29:
        this.$ = new i.IntegerNode(o[a]);
        break;
      case 30:
        this.$ = new i.BooleanNode(o[a]);
        break;
      case 31:
        this.$ = new i.HashNode(o[a]);
        break;
      case 32:
        o[a - 1].push(o[a]), this.$ = o[a - 1];
        break;
      case 33:
        this.$ = [o[a]];
        break;
      case 34:
        this.$ = [o[a - 2], o[a]];
        break;
      case 35:
        this.$ = [o[a - 2], new i.StringNode(o[a])];
        break;
      case 36:
        this.$ = [o[a - 2], new i.IntegerNode(o[a])];
        break;
      case 37:
        this.$ = [o[a - 2], new i.BooleanNode(o[a])];
        break;
      case 38:
        this.$ = new i.IdNode(o[a]);
        break;
      case 39:
        o[a - 2].push(o[a]), this.$ = o[a - 2];
        break;
      case 40:
        this.$ = [o[a]]
      }
    },
    table: [{
      3: 1,
      4: 2,
      5: [2, 4],
      6: 3,
      8: 4,
      9: 5,
      11: 6,
      12: 7,
      13: 8,
      14: [1, 9],
      15: [1, 10],
      16: [1, 12],
      19: [1, 11],
      22: [1, 13],
      23: [1, 14],
      24: [1, 15]
    }, {
      1: [3]
    }, {
      5: [1, 16]
    }, {
      5: [2, 3],
      7: 17,
      8: 18,
      9: 5,
      11: 6,
      12: 7,
      13: 8,
      14: [1, 9],
      15: [1, 10],
      16: [1, 12],
      19: [1, 19],
      20: [2, 3],
      22: [1, 13],
      23: [1, 14],
      24: [1, 15]
    }, {
      5: [2, 5],
      14: [2, 5],
      15: [2, 5],
      16: [2, 5],
      19: [2, 5],
      20: [2, 5],
      22: [2, 5],
      23: [2, 5],
      24: [2, 5]
    }, {
      4: 20,
      6: 3,
      8: 4,
      9: 5,
      11: 6,
      12: 7,
      13: 8,
      14: [1, 9],
      15: [1, 10],
      16: [1, 12],
      19: [1, 11],
      20: [2, 4],
      22: [1, 13],
      23: [1, 14],
      24: [1, 15]
    }, {
      4: 21,
      6: 3,
      8: 4,
      9: 5,
      11: 6,
      12: 7,
      13: 8,
      14: [1, 9],
      15: [1, 10],
      16: [1, 12],
      19: [1, 11],
      20: [2, 4],
      22: [1, 13],
      23: [1, 14],
      24: [1, 15]
    }, {
      5: [2, 9],
      14: [2, 9],
      15: [2, 9],
      16: [2, 9],
      19: [2, 9],
      20: [2, 9],
      22: [2, 9],
      23: [2, 9],
      24: [2, 9]
    }, {
      5: [2, 10],
      14: [2, 10],
      15: [2, 10],
      16: [2, 10],
      19: [2, 10],
      20: [2, 10],
      22: [2, 10],
      23: [2, 10],
      24: [2, 10]
    }, {
      5: [2, 11],
      14: [2, 11],
      15: [2, 11],
      16: [2, 11],
      19: [2, 11],
      20: [2, 11],
      22: [2, 11],
      23: [2, 11],
      24: [2, 11]
    }, {
      5: [2, 12],
      14: [2, 12],
      15: [2, 12],
      16: [2, 12],
      19: [2, 12],
      20: [2, 12],
      22: [2, 12],
      23: [2, 12],
      24: [2, 12]
    }, {
      17: 22,
      21: 23,
      33: [1, 25],
      35: 24
    }, {
      17: 26,
      21: 23,
      33: [1, 25],
      35: 24
    }, {
      17: 27,
      21: 23,
      33: [1, 25],
      35: 24
    }, {
      17: 28,
      21: 23,
      33: [1, 25],
      35: 24
    }, {
      21: 29,
      33: [1, 25],
      35: 24
    }, {
      1: [2, 1]
    }, {
      6: 30,
      8: 4,
      9: 5,
      11: 6,
      12: 7,
      13: 8,
      14: [1, 9],
      15: [1, 10],
      16: [1, 12],
      19: [1, 11],
      22: [1, 13],
      23: [1, 14],
      24: [1, 15]
    }, {
      5: [2, 6],
      14: [2, 6],
      15: [2, 6],
      16: [2, 6],
      19: [2, 6],
      20: [2, 6],
      22: [2, 6],
      23: [2, 6],
      24: [2, 6]
    }, {
      17: 22,
      18: [1, 31],
      21: 23,
      33: [1, 25],
      35: 24
    }, {
      10: 32,
      20: [1, 33]
    }, {
      10: 34,
      20: [1, 33]
    }, {
      18: [1, 35]
    }, {
      18: [2, 24],
      21: 40,
      25: 36,
      26: 37,
      27: 38,
      28: [1, 41],
      29: [1, 42],
      30: [1, 43],
      31: 39,
      32: 44,
      33: [1, 45],
      35: 24
    }, {
      18: [2, 38],
      28: [2, 38],
      29: [2, 38],
      30: [2, 38],
      33: [2, 38],
      36: [1, 46]
    }, {
      18: [2, 40],
      28: [2, 40],
      29: [2, 40],
      30: [2, 40],
      33: [2, 40],
      36: [2, 40]
    }, {
      18: [1, 47]
    }, {
      18: [1, 48]
    }, {
      18: [1, 49]
    }, {
      18: [1, 50],
      21: 51,
      33: [1, 25],
      35: 24
    }, {
      5: [2, 2],
      8: 18,
      9: 5,
      11: 6,
      12: 7,
      13: 8,
      14: [1, 9],
      15: [1, 10],
      16: [1, 12],
      19: [1, 11],
      20: [2, 2],
      22: [1, 13],
      23: [1, 14],
      24: [1, 15]
    }, {
      14: [2, 20],
      15: [2, 20],
      16: [2, 20],
      19: [2, 20],
      22: [2, 20],
      23: [2, 20],
      24: [2, 20]
    }, {
      5: [2, 7],
      14: [2, 7],
      15: [2, 7],
      16: [2, 7],
      19: [2, 7],
      20: [2, 7],
      22: [2, 7],
      23: [2, 7],
      24: [2, 7]
    }, {
      21: 52,
      33: [1, 25],
      35: 24
    }, {
      5: [2, 8],
      14: [2, 8],
      15: [2, 8],
      16: [2, 8],
      19: [2, 8],
      20: [2, 8],
      22: [2, 8],
      23: [2, 8],
      24: [2, 8]
    }, {
      14: [2, 14],
      15: [2, 14],
      16: [2, 14],
      19: [2, 14],
      20: [2, 14],
      22: [2, 14],
      23: [2, 14],
      24: [2, 14]
    }, {
      18: [2, 22],
      21: 40,
      26: 53,
      27: 54,
      28: [1, 41],
      29: [1, 42],
      30: [1, 43],
      31: 39,
      32: 44,
      33: [1, 45],
      35: 24
    }, {
      18: [2, 23]
    }, {
      18: [2, 26],
      28: [2, 26],
      29: [2, 26],
      30: [2, 26],
      33: [2, 26]
    }, {
      18: [2, 31],
      32: 55,
      33: [1, 56]
    }, {
      18: [2, 27],
      28: [2, 27],
      29: [2, 27],
      30: [2, 27],
      33: [2, 27]
    }, {
      18: [2, 28],
      28: [2, 28],
      29: [2, 28],
      30: [2, 28],
      33: [2, 28]
    }, {
      18: [2, 29],
      28: [2, 29],
      29: [2, 29],
      30: [2, 29],
      33: [2, 29]
    }, {
      18: [2, 30],
      28: [2, 30],
      29: [2, 30],
      30: [2, 30],
      33: [2, 30]
    }, {
      18: [2, 33],
      33: [2, 33]
    }, {
      18: [2, 40],
      28: [2, 40],
      29: [2, 40],
      30: [2, 40],
      33: [2, 40],
      34: [1, 57],
      36: [2, 40]
    }, {
      33: [1, 58]
    }, {
      14: [2, 13],
      15: [2, 13],
      16: [2, 13],
      19: [2, 13],
      20: [2, 13],
      22: [2, 13],
      23: [2, 13],
      24: [2, 13]
    }, {
      5: [2, 16],
      14: [2, 16],
      15: [2, 16],
      16: [2, 16],
      19: [2, 16],
      20: [2, 16],
      22: [2, 16],
      23: [2, 16],
      24: [2, 16]
    }, {
      5: [2, 17],
      14: [2, 17],
      15: [2, 17],
      16: [2, 17],
      19: [2, 17],
      20: [2, 17],
      22: [2, 17],
      23: [2, 17],
      24: [2, 17]
    }, {
      5: [2, 18],
      14: [2, 18],
      15: [2, 18],
      16: [2, 18],
      19: [2, 18],
      20: [2, 18],
      22: [2, 18],
      23: [2, 18],
      24: [2, 18]
    }, {
      18: [1, 59]
    }, {
      18: [1, 60]
    }, {
      18: [2, 21]
    }, {
      18: [2, 25],
      28: [2, 25],
      29: [2, 25],
      30: [2, 25],
      33: [2, 25]
    }, {
      18: [2, 32],
      33: [2, 32]
    }, {
      34: [1, 57]
    }, {
      21: 61,
      28: [1, 62],
      29: [1, 63],
      30: [1, 64],
      33: [1, 25],
      35: 24
    }, {
      18: [2, 39],
      28: [2, 39],
      29: [2, 39],
      30: [2, 39],
      33: [2, 39],
      36: [2, 39]
    }, {
      5: [2, 19],
      14: [2, 19],
      15: [2, 19],
      16: [2, 19],
      19: [2, 19],
      20: [2, 19],
      22: [2, 19],
      23: [2, 19],
      24: [2, 19]
    }, {
      5: [2, 15],
      14: [2, 15],
      15: [2, 15],
      16: [2, 15],
      19: [2, 15],
      20: [2, 15],
      22: [2, 15],
      23: [2, 15],
      24: [2, 15]
    }, {
      18: [2, 34],
      33: [2, 34]
    }, {
      18: [2, 35],
      33: [2, 35]
    }, {
      18: [2, 36],
      33: [2, 36]
    }, {
      18: [2, 37],
      33: [2, 37]
    }],
    defaultActions: {
      16: [2, 1],
      37: [2, 23],
      53: [2, 21]
    },
    parseError: function(t, n) {
      throw new Error(t)
    },
    parse: function(t) {
      function d(e) {
        r.length = r.length - 2 * e, i.length = i.length - e, s.length = s.length - e
      }
      function v() {
        var e;
        return e = n.lexer.lex() || 1, typeof e != "number" && (e = n.symbols_[e] || e), e
      }
      var n = this,
        r = [0],
        i = [null],
        s = [],
        o = this.table,
        u = "",
        a = 0,
        f = 0,
        l = 0,
        c = 2,
        h = 1;
      this.lexer.setInput(t), this.lexer.yy = this.yy, this.yy.lexer = this.lexer, typeof this.lexer.yylloc == "undefined" && (this.lexer.yylloc = {});
      var p = this.lexer.yylloc;
      s.push(p), typeof this.yy.parseError == "function" && (this.parseError = this.yy.parseError);
      var m, g, y, b, w, E, S = {}, x, T, N, C;
      for(;;) {
        y = r[r.length - 1], this.defaultActions[y] ? b = this.defaultActions[y] : (m == null && (m = v()), b = o[y] && o[y][m]);
        if(typeof b == "undefined" || !b.length || !b[0]) if(!l) {
          C = [];
          for(x in o[y]) this.terminals_[x] && x > 2 && C.push("'" + this.terminals_[x] + "'");
          var k = "";
          this.lexer.showPosition ? k = "Parse error on line " + (a + 1) + ":\n" + this.lexer.showPosition() + "\nExpecting " + C.join(", ") + ", got '" + this.terminals_[m] + "'" : k = "Parse error on line " + (a + 1) + ": Unexpected " + (m == 1 ? "end of input" : "'" + (this.terminals_[m] || m) + "'"), this.parseError(k, {
            text: this.lexer.match,
            token: this.terminals_[m] || m,
            line: this.lexer.yylineno,
            loc: p,
            expected: C
          })
        }
        if(b[0] instanceof Array && b.length > 1) throw new Error("Parse Error: multiple actions possible at state: " + y + ", token: " + m);
        switch(b[0]) {
        case 1:
          r.push(m), i.push(this.lexer.yytext), s.push(this.lexer.yylloc), r.push(b[1]), m = null, g ? (m = g, g = null) : (f = this.lexer.yyleng, u = this.lexer.yytext, a = this.lexer.yylineno, p = this.lexer.yylloc, l > 0 && l--);
          break;
        case 2:
          T = this.productions_[b[1]][1], S.$ = i[i.length - T], S._$ = {
            first_line: s[s.length - (T || 1)].first_line,
            last_line: s[s.length - 1].last_line,
            first_column: s[s.length - (T || 1)].first_column,
            last_column: s[s.length - 1].last_column
          }, E = this.performAction.call(S, u, f, a, this.yy, b[1], i, s);
          if(typeof E != "undefined") return E;
          T && (r = r.slice(0, - 1 * T * 2), i = i.slice(0, - 1 * T), s = s.slice(0, - 1 * T)), r.push(this.productions_[b[1]][0]), i.push(S.$), s.push(S._$), N = o[r[r.length - 2]][r[r.length - 1]], r.push(N);
          break;
        case 3:
          return !0
        }
      }
      return !0
    }
  }, t = function() {
    var e = {
      EOF: 1,
      parseError: function(t, n) {
        if(!this.yy.parseError) throw new Error(t);
        this.yy.parseError(t, n)
      },
      setInput: function(e) {
        return this._input = e, this._more = this._less = this.done = !1, this.yylineno = this.yyleng = 0, this.yytext = this.matched = this.match = "", this.conditionStack = ["INITIAL"], this.yylloc = {
          first_line: 1,
          first_column: 0,
          last_line: 1,
          last_column: 0
        }, this
      },
      input: function() {
        var e = this._input[0];
        this.yytext += e, this.yyleng++, this.match += e, this.matched += e;
        var t = e.match(/\n/);
        return t && this.yylineno++, this._input = this._input.slice(1), e
      },
      unput: function(e) {
        return this._input = e + this._input, this
      },
      more: function() {
        return this._more = !0, this
      },
      pastInput: function() {
        var e = this.matched.substr(0, this.matched.length - this.match.length);
        return(e.length > 20 ? "..." : "") + e.substr(-20).replace(/\n/g, "")
      },
      upcomingInput: function() {
        var e = this.match;
        return e.length < 20 && (e += this._input.substr(0, 20 - e.length)), (e.substr(0, 20) + (e.length > 20 ? "..." : "")).replace(/\n/g, "")
      },
      showPosition: function() {
        var e = this.pastInput(),
          t = (new Array(e.length + 1)).join("-");
        return e + this.upcomingInput() + "\n" + t + "^"
      },
      next: function() {
        if(this.done) return this.EOF;
        this._input || (this.done = !0);
        var e, t, n, r;
        this._more || (this.yytext = "", this.match = "");
        var i = this._currentRules();
        for(var s = 0; s < i.length; s++) {
          t = this._input.match(this.rules[i[s]]);
          if(t) {
            r = t[0].match(/\n.*/g), r && (this.yylineno += r.length), this.yylloc = {
              first_line: this.yylloc.last_line,
              last_line: this.yylineno + 1,
              first_column: this.yylloc.last_column,
              last_column: r ? r[r.length - 1].length - 1 : this.yylloc.last_column + t[0].length
            }, this.yytext += t[0], this.match += t[0], this.matches = t, this.yyleng = this.yytext.length, this._more = !1, this._input = this._input.slice(t[0].length), this.matched += t[0], e = this.performAction.call(this, this.yy, this, i[s], this.conditionStack[this.conditionStack.length - 1]);
            if(e) return e;
            return
          }
        }
        if(this._input === "") return this.EOF;
        this.parseError("Lexical error on line " + (this.yylineno + 1) + ". Unrecognized text.\n" + this.showPosition(), {
          text: "",
          token: null,
          line: this.yylineno
        })
      },
      lex: function() {
        var t = this.next();
        return typeof t != "undefined" ? t : this.lex()
      },
      begin: function(t) {
        this.conditionStack.push(t)
      },
      popState: function() {
        return this.conditionStack.pop()
      },
      _currentRules: function() {
        return this.conditions[this.conditionStack[this.conditionStack.length - 1]].rules
      },
      topState: function() {
        return this.conditionStack[this.conditionStack.length - 2]
      },
      pushState: function(t) {
        this.begin(t)
      }
    };
    return e.performAction = function(t, n, r, i) {
      var s = i;
      switch(r) {
      case 0:
        n.yytext.slice(-1) !== "\\" && this.begin("mu"), n.yytext.slice(-1) === "\\" && (n.yytext = n.yytext.substr(0, n.yyleng - 1), this.begin("emu"));
        if(n.yytext) return 14;
        break;
      case 1:
        return 14;
      case 2:
        return this.popState(), 14;
      case 3:
        return 24;
      case 4:
        return 16;
      case 5:
        return 20;
      case 6:
        return 19;
      case 7:
        return 19;
      case 8:
        return 23;
      case 9:
        return 23;
      case 10:
        return n.yytext = n.yytext.substr(3, n.yyleng - 5), this.popState(), 15;
      case 11:
        return 22;
      case 12:
        return 34;
      case 13:
        return 33;
      case 14:
        return 33;
      case 15:
        return 36;
      case 16:
        break;
      case 17:
        return this.popState(), 18;
      case 18:
        return this.popState(), 18;
      case 19:
        return n.yytext = n.yytext.substr(1, n.yyleng - 2).replace(/\\"/g, '"'), 28;
      case 20:
        return 30;
      case 21:
        return 30;
      case 22:
        return 29;
      case 23:
        return 33;
      case 24:
        return n.yytext = n.yytext.substr(1, n.yyleng - 2), 33;
      case 25:
        return "INVALID";
      case 26:
        return 5
      }
    }, e.rules = [/^[^\x00]*?(?=(\{\{))/, /^[^\x00]+/, /^[^\x00]{2,}?(?=(\{\{))/, /^\{\{>/, /^\{\{#/, /^\{\{\//, /^\{\{\^/, /^\{\{\s*else\b/, /^\{\{\{/, /^\{\{&/, /^\{\{![\s\S]*?\}\}/, /^\{\{/, /^=/, /^\.(?=[} ])/, /^\.\./, /^[\/.]/, /^\s+/, /^\}\}\}/, /^\}\}/, /^"(\\["]|[^"])*"/, /^true(?=[}\s])/, /^false(?=[}\s])/, /^[0-9]+(?=[}\s])/, /^[a-zA-Z0-9_$-]+(?=[=}\s\/.])/, /^\[[^\]]*\]/, /^./, /^$/], e.conditions = {
      mu: {
        rules: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26],
        inclusive: !1
      },
      emu: {
        rules: [2],
        inclusive: !1
      },
      INITIAL: {
        rules: [0, 1, 26],
        inclusive: !0
      }
    }, e
  }();
  return e.lexer = t, e
}();
typeof require != "undefined" && typeof exports != "undefined" && (exports.parser = handlebars, exports.parse = function() {
  return handlebars.parse.apply(handlebars, arguments)
}, exports.main = function(t) {
  if(!t[1]) throw new Error("Usage: " + t[0] + " FILE");
  if(typeof process != "undefined") var n = require("fs").readFileSync(require("path").join(process.cwd(), t[1]), "utf8");
  else var r = require("file").path(require("file").cwd()),
    n = r.join(t[1]).read({
      charset: "utf-8"
    });
  return exports.parser.parse(n)
}, typeof module != "undefined" && require.main === module && exports.main(typeof process != "undefined" ? process.argv.slice(1) : require("system").args)), Handlebars.Parser = handlebars, Handlebars.parse = function(e) {
  return Handlebars.Parser.yy = Handlebars.AST, Handlebars.Parser.parse(e)
}, Handlebars.print = function(e) {
  return(new Handlebars.PrintVisitor).accept(e)
}, Handlebars.logger = {
  DEBUG: 0,
  INFO: 1,
  WARN: 2,
  ERROR: 3,
  level: 3,
  log: function(e, t) {}
}, Handlebars.log = function(e, t) {
  Handlebars.logger.log(e, t)
},
function() {
  Handlebars.AST = {}, Handlebars.AST.ProgramNode = function(e, t) {
    this.type = "program", this.statements = e, t && (this.inverse = new Handlebars.AST.ProgramNode(t))
  }, Handlebars.AST.MustacheNode = function(e, t, n) {
    this.type = "mustache", this.id = e[0], this.params = e.slice(1), this.hash = t, this.escaped = !n
  }, Handlebars.AST.PartialNode = function(e, t) {
    this.type = "partial", this.id = e, this.context = t
  };
  var e = function(e, t) {
    if(e.original !== t.original) throw new Handlebars.Exception(e.original + " doesn't match " + t.original)
  };
  Handlebars.AST.BlockNode = function(t, n, r) {
    e(t.id, r), this.type = "block", this.mustache = t, this.program = n
  }, Handlebars.AST.InverseNode = function(t, n, r) {
    e(t.id, r), this.type = "inverse", this.mustache = t, this.program = n
  }, Handlebars.AST.ContentNode = function(e) {
    this.type = "content", this.string = e
  }, Handlebars.AST.HashNode = function(e) {
    this.type = "hash", this.pairs = e
  }, Handlebars.AST.IdNode = function(e) {
    this.type = "ID", this.original = e.join(".");
    var t = [],
      n = 0;
    for(var r = 0, i = e.length; r < i; r++) {
      var s = e[r];
      s === ".." ? n++ : s === "." || s === "this" ? this.isScoped = !0 : t.push(s)
    }
    this.parts = t, this.string = t.join("."), this.depth = n, this.isSimple = t.length === 1 && n === 0
  }, Handlebars.AST.StringNode = function(e) {
    this.type = "STRING", this.string = e
  }, Handlebars.AST.IntegerNode = function(e) {
    this.type = "INTEGER", this.integer = e
  }, Handlebars.AST.BooleanNode = function(e) {
    this.type = "BOOLEAN", this.bool = e
  }, Handlebars.AST.CommentNode = function(e) {
    this.type = "comment", this.comment = e
  }
}(), Handlebars.Exception = function(e) {
  var t = Error.prototype.constructor.apply(this, arguments);
  for(var n in t) t.hasOwnProperty(n) && (this[n] = t[n]);
  this.message = t.message
}, Handlebars.Exception.prototype = new Error, Handlebars.SafeString = function(e) {
  this.string = e
}, Handlebars.SafeString.prototype.toString = function() {
  return this.string.toString()
},
function() {
  var e = {
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#x27;",
    "`": "&#x60;"
  }, t = /&(?!\w+;)|[<>"'`]/g,
    n = /[&<>"'`]/,
    r = function(t) {
      return e[t] || "&amp;"
    };
  Handlebars.Utils = {
    escapeExpression: function(e) {
      return e instanceof Handlebars.SafeString ? e.toString() : e == null || e === !1 ? "" : n.test(e) ? e.replace(t, r) : e
    },
    isEmpty: function(e) {
      return typeof e == "undefined" ? !0 : e === null ? !0 : e === !1 ? !0 : Object.prototype.toString.call(e) === "[object Array]" && e.length === 0 ? !0 : !1
    }
  }
}(), Handlebars.Compiler = function() {}, Handlebars.JavaScriptCompiler = function() {},
function(e, t) {
  e.OPCODE_MAP = {
    appendContent: 1,
    getContext: 2,
    lookupWithHelpers: 3,
    lookup: 4,
    append: 5,
    invokeMustache: 6,
    appendEscaped: 7,
    pushString: 8,
    truthyOrFallback: 9,
    functionOrFallback: 10,
    invokeProgram: 11,
    invokePartial: 12,
    push: 13,
    assignToHash: 15,
    pushStringParam: 16
  }, e.MULTI_PARAM_OPCODES = {
    appendContent: 1,
    getContext: 1,
    lookupWithHelpers: 2,
    lookup: 1,
    invokeMustache: 3,
    pushString: 1,
    truthyOrFallback: 1,
    functionOrFallback: 1,
    invokeProgram: 3,
    invokePartial: 1,
    push: 1,
    assignToHash: 1,
    pushStringParam: 1
  }, e.DISASSEMBLE_MAP = {};
  for(var n in e.OPCODE_MAP) {
    var r = e.OPCODE_MAP[n];
    e.DISASSEMBLE_MAP[r] = n
  }
  e.multiParamSize = function(t) {
    return e.MULTI_PARAM_OPCODES[e.DISASSEMBLE_MAP[t]]
  }, e.prototype = {
    compiler: e,
    disassemble: function() {
      var t = this.opcodes,
        n, r, i = [],
        s, o, u;
      for(var a = 0, f = t.length; a < f; a++) {
        n = t[a];
        if(n === "DECLARE") o = t[++a], u = t[++a], i.push("DECLARE " + o + " = " + u);
        else {
          s = e.DISASSEMBLE_MAP[n];
          var l = e.multiParamSize(n),
            c = [];
          for(var h = 0; h < l; h++) r = t[++a], typeof r == "string" && (r = '"' + r.replace("\n", "\\n") + '"'), c.push(r);
          s = s + " " + c.join(" "), i.push(s)
        }
      }
      return i.join("\n")
    },
    guid: 0,
    compile: function(e, t) {
      this.children = [], this.depths = {
        list: []
      }, this.options = t;
      var n = this.options.knownHelpers;
      this.options.knownHelpers = {
        helperMissing: !0,
        blockHelperMissing: !0,
        each: !0,
        "if": !0,
        unless: !0,
        "with": !0,
        log: !0
      };
      if(n) for(var r in n) this.options.knownHelpers[r] = n[r];
      return this.program(e)
    },
    accept: function(e) {
      return this[e.type](e)
    },
    program: function(e) {
      var t = e.statements,
        n;
      this.opcodes = [];
      for(var r = 0, i = t.length; r < i; r++) n = t[r], this[n.type](n);
      return this.isSimple = i === 1, this.depths.list = this.depths.list.sort(function(e, t) {
        return e - t
      }), this
    },
    compileProgram: function(e) {
      var t = (new this.compiler).compile(e, this.options),
        n = this.guid++;
      this.usePartial = this.usePartial || t.usePartial, this.children[n] = t;
      for(var r = 0, i = t.depths.list.length; r < i; r++) {
        depth = t.depths.list[r];
        if(depth < 2) continue;
        this.addDepth(depth - 1)
      }
      return n
    },
    block: function(e) {
      var t = e.mustache,
        n, r, i, s, o = this.setupStackForMustache(t),
        u = this.compileProgram(e.program);
      e.program.inverse && (s = this.compileProgram(e.program.inverse), this.declare("inverse", s)), this.opcode("invokeProgram", u, o.length, !! t.hash), this.declare("inverse", null), this.opcode("append")
    },
    inverse: function(e) {
      var t = this.setupStackForMustache(e.mustache),
        n = this.compileProgram(e.program);
      this.declare("inverse", n), this.opcode("invokeProgram", null, t.length, !! e.mustache.hash), this.declare("inverse", null), this.opcode("append")
    },
    hash: function(e) {
      var t = e.pairs,
        n, r;
      this.opcode("push", "{}");
      for(var i = 0, s = t.length; i < s; i++) n = t[i], r = n[1], this.accept(r), this.opcode("assignToHash", n[0])
    },
    partial: function(e) {
      var t = e.id;
      this.usePartial = !0, e.context ? this.ID(e.context) : this.opcode("push", "depth0"), this.opcode("invokePartial", t.original), this.opcode("append")
    },
    content: function(e) {
      this.opcode("appendContent", e.string)
    },
    mustache: function(e) {
      var t = this.setupStackForMustache(e);
      this.opcode("invokeMustache", t.length, e.id.original, !! e.hash), e.escaped && !this.options.noEscape ? this.opcode("appendEscaped") : this.opcode("append")
    },
    ID: function(e) {
      this.addDepth(e.depth), this.opcode("getContext", e.depth), this.opcode("lookupWithHelpers", e.parts[0] || null, e.isScoped || !1);
      for(var t = 1, n = e.parts.length; t < n; t++) this.opcode("lookup", e.parts[t])
    },
    STRING: function(e) {
      this.opcode("pushString", e.string)
    },
    INTEGER: function(e) {
      this.opcode("push", e.integer)
    },
    BOOLEAN: function(e) {
      this.opcode("push", e.bool)
    },
    comment: function() {},
    pushParams: function(e) {
      var t = e.length,
        n;
      while(t--) n = e[t], this.options.stringParams ? (n.depth && this.addDepth(n.depth), this.opcode("getContext", n.depth || 0), this.opcode("pushStringParam", n.string)) : this[n.type](n)
    },
    opcode: function(t, n, r, i) {
      this.opcodes.push(e.OPCODE_MAP[t]), n !== undefined && this.opcodes.push(n), r !== undefined && this.opcodes.push(r), i !== undefined && this.opcodes.push(i)
    },
    declare: function(e, t) {
      this.opcodes.push("DECLARE"), this.opcodes.push(e), this.opcodes.push(t)
    },
    addDepth: function(e) {
      if(e === 0) return;
      this.depths[e] || (this.depths[e] = !0, this.depths.list.push(e))
    },
    setupStackForMustache: function(e) {
      var t = e.params;
      return this.pushParams(t), e.hash && this.hash(e.hash), this.ID(e.id), t
    }
  }, t.prototype = {
    nameLookup: function(e, n, r) {
      return /^[0-9]+$/.test(n) ? e + "[" + n + "]" : t.isValidJavaScriptVariableName(n) ? e + "." + n : e + "['" + n + "']"
    },
    appendToBuffer: function(e) {
      return this.environment.isSimple ? "return " + e + ";" : "buffer += " + e + ";"
    },
    initializeBuffer: function() {
      return this.quotedString("")
    },
    namespace: "Handlebars",
    compile: function(e, t, n, r) {
      this.environment = e, this.options = t || {}, this.name = this.environment.name, this.isChild = !! n, this.context = n || {
        programs: [],
        aliases: {
          self: "this"
        },
        registers: {
          list: []
        }
      }, this.preamble(), this.stackSlot = 0, this.stackVars = [], this.compileChildren(e, t);
      var i = e.opcodes,
        s;
      this.i = 0;
      for(u = i.length; this.i < u; this.i++) s = this.nextOpcode(0), s[0] === "DECLARE" ? (this.i = this.i + 2, this[s[1]] = s[2]) : (this.i = this.i + s[1].length, this[s[0]].apply(this, s[1]));
      return this.createFunctionContext(r)
    },
    nextOpcode: function(t) {
      var n = this.environment.opcodes,
        r = n[this.i + t],
        i, s, o, u;
      if(r === "DECLARE") return i = n[this.i + 1], s = n[this.i + 2], ["DECLARE", i, s];
      i = e.DISASSEMBLE_MAP[r], o = e.multiParamSize(r), u = [];
      for(var a = 0; a < o; a++) u.push(n[this.i + a + 1 + t]);
      return [i, u]
    },
    eat: function(e) {
      this.i = this.i + e.length
    },
    preamble: function() {
      var e = [];
      this.useRegister("foundHelper");
      if(!this.isChild) {
        var t = this.namespace,
          n = "helpers = helpers || " + t + ".helpers;";
        this.environment.usePartial && (n = n + " partials = partials || " + t + ".partials;"), e.push(n)
      } else e.push("");
      this.environment.isSimple ? e.push("") : e.push(", buffer = " + this.initializeBuffer()), this.lastContext = 0, this.source = e
    },
    createFunctionContext: function(e) {
      var t = this.stackVars;
      this.isChild || (t = t.concat(this.context.registers.list)), t.length > 0 && (this.source[1] = this.source[1] + ", " + t.join(", "));
      if(!this.isChild) {
        var n = [];
        for(var r in this.context.aliases) this.source[1] = this.source[1] + ", " + r + "=" + this.context.aliases[r]
      }
      this.source[1] && (this.source[1] = "var " + this.source[1].substring(2) + ";"), this.isChild || (this.source[1] += "\n" + this.context.programs.join("\n") + "\n"), this.environment.isSimple || this.source.push("return buffer;");
      var i = this.isChild ? ["depth0", "data"] : ["Handlebars", "depth0", "helpers", "partials", "data"];
      for(var s = 0, o = this.environment.depths.list.length; s < o; s++) i.push("depth" + this.environment.depths.list[s]);
      if(e) return i.push(this.source.join("\n  ")), Function.apply(this, i);
      var u = "function " + (this.name || "") + "(" + i.join(",") + ") {\n  " + this.source.join("\n  ") + "}";
      return Handlebars.log(Handlebars.logger.DEBUG, u + "\n\n"), u
    },
    appendContent: function(e) {
      this.source.push(this.appendToBuffer(this.quotedString(e)))
    },
    append: function() {
      var e = this.popStack();
      this.source.push("if(" + e + " || " + e + " === 0) { " + this.appendToBuffer(e) + " }"), this.environment.isSimple && this.source.push("else { " + this.appendToBuffer("''") + " }")
    },
    appendEscaped: function() {
      var e = this.nextOpcode(1),
        t = "";
      this.context.aliases.escapeExpression = "this.escapeExpression", e[0] === "appendContent" && (t = " + " + this.quotedString(e[1][0]), this.eat(e)), this.source.push(this.appendToBuffer("escapeExpression(" + this.popStack() + ")" + t))
    },
    getContext: function(e) {
      this.lastContext !== e && (this.lastContext = e)
    },
    lookupWithHelpers: function(e, t) {
      if(e) {
        var n = this.nextStack();
        this.usingKnownHelper = !1;
        var r;
        !t && this.options.knownHelpers[e] ? (r = n + " = " + this.nameLookup("helpers", e, "helper"), this.usingKnownHelper = !0) : t || this.options.knownHelpersOnly ? r = n + " = " + this.nameLookup("depth" + this.lastContext, e, "context") : (this.register("foundHelper", this.nameLookup("helpers", e, "helper")), r = n + " = foundHelper || " + this.nameLookup("depth" + this.lastContext, e, "context")), r += ";", this.source.push(r)
      } else this.pushStack("depth" + this.lastContext)
    },
    lookup: function(e) {
      var t = this.topStack();
      this.source.push(t + " = (" + t + " === null || " + t + " === undefined || " + t + " === false ? " + t + " : " + this.nameLookup(t, e, "context") + ");")
    },
    pushStringParam: function(e) {
      this.pushStack("depth" + this.lastContext), this.pushString(e)
    },
    pushString: function(e) {
      this.pushStack(this.quotedString(e))
    },
    push: function(e) {
      this.pushStack(e)
    },
    invokeMustache: function(e, t, n) {
      this.populateParams(e, this.quotedString(t), "{}", null, n, function(e, t, n) {
        this.usingKnownHelper || (this.context.aliases.helperMissing = "helpers.helperMissing", this.context.aliases.undef = "void 0", this.source.push("else if(" + n + "=== undef) { " + e + " = helperMissing.call(" + t + "); }"), e !== n && this.source.push("else { " + e + " = " + n + "; }"))
      })
    },
    invokeProgram: function(e, t, n) {
      var r = this.programExpression(this.inverse),
        i = this.programExpression(e);
      this.populateParams(t, null, i, r, n, function(e, t, n) {
        this.usingKnownHelper || (this.context.aliases.blockHelperMissing = "helpers.blockHelperMissing", this.source.push("else { " + e + " = blockHelperMissing.call(" + t + "); }"))
      })
    },
    populateParams: function(e, t, n, r, i, s) {
      var o = i || this.options.stringParams || r || this.options.data,
        u = this.popStack(),
        a, f = [],
        l, c, h;
      o ? (this.register("tmp1", n), h = "tmp1") : h = "{ hash: {} }";
      if(o) {
        var p = i ? this.popStack() : "{}";
        this.source.push("tmp1.hash = " + p + ";")
      }
      this.options.stringParams && this.source.push("tmp1.contexts = [];");
      for(var d = 0; d < e; d++) l = this.popStack(), f.push(l), this.options.stringParams && this.source.push("tmp1.contexts.push(" + this.popStack() + ");");
      r && (this.source.push("tmp1.fn = tmp1;"), this.source.push("tmp1.inverse = " + r + ";")), this.options.data && this.source.push("tmp1.data = data;"), f.push(h), this.populateCall(f, u, t || u, s, n !== "{}")
    },
    populateCall: function(e, t, n, r, i) {
      var s = ["depth0"].concat(e).join(", "),
        o = ["depth0"].concat(n).concat(e).join(", "),
        u = this.nextStack();
      if(this.usingKnownHelper) this.source.push(u + " = " + t + ".call(" + s + ");");
      else {
        this.context.aliases.functionType = '"function"';
        var a = i ? "foundHelper && " : "";
        this.source.push("if(" + a + "typeof " + t + " === functionType) { " + u + " = " + t + ".call(" + s + "); }")
      }
      r.call(this, u, o, t), this.usingKnownHelper = !1
    },
    invokePartial: function(e) {
      params = [this.nameLookup("partials", e, "partial"), "'" + e + "'", this.popStack(), "helpers", "partials"], this.options.data && params.push("data"), this.pushStack("self.invokePartial(" + params.join(", ") + ");")
    },
    assignToHash: function(e) {
      var t = this.popStack(),
        n = this.topStack();
      this.source.push(n + "['" + e + "'] = " + t + ";")
    },
    compiler: t,
    compileChildren: function(e, t) {
      var n = e.children,
        r, i;
      for(var s = 0, o = n.length; s < o; s++) {
        r = n[s], i = new this.compiler, this.context.programs.push("");
        var u = this.context.programs.length;
        r.index = u, r.name = "program" + u, this.context.programs[u] = i.compile(r, t, this.context)
      }
    },
    programExpression: function(e) {
      if(e == null) return "self.noop";
      var t = this.environment.children[e],
        n = t.depths.list,
        r = [t.index, t.name, "data"];
      for(var i = 0, s = n.length; i < s; i++) depth = n[i], depth === 1 ? r.push("depth0") : r.push("depth" + (depth - 1));
      return n.length === 0 ? "self.program(" + r.join(", ") + ")" : (r.shift(), "self.programWithDepth(" + r.join(", ") + ")")
    },
    register: function(e, t) {
      this.useRegister(e), this.source.push(e + " = " + t + ";")
    },
    useRegister: function(e) {
      this.context.registers[e] || (this.context.registers[e] = !0, this.context.registers.list.push(e))
    },
    pushStack: function(e) {
      return this.source.push(this.nextStack() + " = " + e + ";"), "stack" + this.stackSlot
    },
    nextStack: function() {
      return this.stackSlot++, this.stackSlot > this.stackVars.length && this.stackVars.push("stack" + this.stackSlot), "stack" + this.stackSlot
    },
    popStack: function() {
      return "stack" + this.stackSlot--
    },
    topStack: function() {
      return "stack" + this.stackSlot
    },
    quotedString: function(e) {
      return '"' + e.replace(/\\/g, "\\\\").replace(/"/g, '\\"').replace(/\n/g, "\\n").replace(/\r/g, "\\r") + '"'
    }
  };
  var i = "break else new var case finally return void catch for switch while continue function this with default if throw delete in try do instanceof typeof abstract enum int short boolean export interface static byte extends long super char final native synchronized class float package throws const goto private transient debugger implements protected volatile double import public let yield".split(" "),
    s = t.RESERVED_WORDS = {};
  for(var o = 0, u = i.length; o < u; o++) s[i[o]] = !0;
  t.isValidJavaScriptVariableName = function(e) {
    return !t.RESERVED_WORDS[e] && /^[a-zA-Z_$][0-9a-zA-Z_$]+$/.test(e) ? !0 : !1
  }
}(Handlebars.Compiler, Handlebars.JavaScriptCompiler), Handlebars.precompile = function(e, t) {
  t = t || {};
  var n = Handlebars.parse(e),
    r = (new Handlebars.Compiler).compile(n, t);
  return(new Handlebars.JavaScriptCompiler).compile(r, t)
}, Handlebars.compile = function(e, t) {
  function r() {
    var n = Handlebars.parse(e),
      r = (new Handlebars.Compiler).compile(n, t),
      i = (new Handlebars.JavaScriptCompiler).compile(r, t, undefined, !0);
    return Handlebars.template(i)
  }
  t = t || {};
  var n;
  return function(e, t) {
    return n || (n = r()), n.call(this, e, t)
  }
}, Handlebars.VM = {
  template: function(e) {
    var t = {
      escapeExpression: Handlebars.Utils.escapeExpression,
      invokePartial: Handlebars.VM.invokePartial,
      programs: [],
      program: function(e, t, n) {
        var r = this.programs[e];
        return n ? Handlebars.VM.program(t, n) : r ? r : (r = this.programs[e] = Handlebars.VM.program(t), r)
      },
      programWithDepth: Handlebars.VM.programWithDepth,
      noop: Handlebars.VM.noop
    };
    return function(n, r) {
      return r = r || {}, e.call(t, Handlebars, n, r.helpers, r.partials, r.data)
    }
  },
  programWithDepth: function(e, t, n) {
    var r = Array.prototype.slice.call(arguments, 2);
    return function(n, i) {
      return i = i || {}, e.apply(this, [n, i.data || t].concat(r))
    }
  },
  program: function(e, t) {
    return function(n, r) {
      return r = r || {}, e(n, r.data || t)
    }
  },
  noop: function() {
    return ""
  },
  invokePartial: function(e, t, n, r, i, s) {
    options = {
      helpers: r,
      partials: i,
      data: s
    };
    if(e === undefined) throw new Handlebars.Exception("The partial " + t + " could not be found");
    if(e instanceof Function) return e(n, options);
    if(!Handlebars.compile) throw new Handlebars.Exception("The partial " + t + " could not be compiled when running in runtime-only mode");
    return i[t] = Handlebars.compile(e), i[t](n, options)
  }
}, Handlebars.template = Handlebars.VM.template,
function(e) {
  e.extend(e.fn, {
    validate: function(t) {
      if(!this.length) {
        t && t.debug && window.console && console.warn("Nothing selected, can't validate, returning nothing.");
        return
      }
      var n = e.data(this[0], "validator");
      return n ? n : (this.attr("novalidate", "novalidate"), n = new e.validator(t, this[0]), e.data(this[0], "validator", n), n.settings.onsubmit && (this.validateDelegate(":submit", "click", function(t) {
        n.settings.submitHandler && (n.submitButton = t.target), e(t.target).hasClass("cancel") && (n.cancelSubmit = !0)
      }), this.submit(function(t) {
        function r() {
          var r;
          return n.settings.submitHandler ? (n.submitButton && (r = e("<input type='hidden'/>").attr("name", n.submitButton.name).val(n.submitButton.value).appendTo(n.currentForm)), n.settings.submitHandler.call(n, n.currentForm, t), n.submitButton && r.remove(), !1) : !0
        }
        return n.settings.debug && t.preventDefault(), n.cancelSubmit ? (n.cancelSubmit = !1, r()) : n.form() ? n.pendingRequest ? (n.formSubmitted = !0, !1) : r() : (n.focusInvalid(), !1)
      })), n)
    },
    valid: function() {
      if(e(this[0]).is("form")) return this.validate().form();
      var t = !0,
        n = e(this[0].form).validate();
      return this.each(function() {
        t &= n.element(this)
      }), t
    },
    removeAttrs: function(t) {
      var n = {}, r = this;
      return e.each(t.split(/\s/), function(e, t) {
        n[t] = r.attr(t), r.removeAttr(t)
      }), n
    },
    rules: function(t, n) {
      var r = this[0];
      if(t) {
        var i = e.data(r.form, "validator").settings,
          s = i.rules,
          o = e.validator.staticRules(r);
        switch(t) {
        case "add":
          e.extend(o, e.validator.normalizeRule(n)), s[r.name] = o, n.messages && (i.messages[r.name] = e.extend(i.messages[r.name], n.messages));
          break;
        case "remove":
          if(!n) return delete s[r.name], o;
          var u = {};
          return e.each(n.split(/\s/), function(e, t) {
            u[t] = o[t], delete o[t]
          }), u
        }
      }
      var a = e.validator.normalizeRules(e.extend({}, e.validator.classRules(r), e.validator.attributeRules(r), e.validator.dataRules(r), e.validator.staticRules(r)), r);
      if(a.required) {
        var f = a.required;
        delete a.required, a = e.extend({
          required: f
        }, a)
      }
      return a
    }
  }), e.extend(e.expr[":"], {
    blank: function(t) {
      return !e.trim("" + t.value)
    },
    filled: function(t) {
      return !!e.trim("" + t.value)
    },
    unchecked: function(e) {
      return !e.checked
    }
  }), e.validator = function(t, n) {
    this.settings = e.extend(!0, {}, e.validator.defaults, t), this.currentForm = n, this.init()
  }, e.validator.format = function(t, n) {
    return arguments.length === 1 ? function() {
      var n = e.makeArray(arguments);
      return n.unshift(t), e.validator.format.apply(this, n)
    } : (arguments.length > 2 && n.constructor !== Array && (n = e.makeArray(arguments).slice(1)), n.constructor !== Array && (n = [n]), e.each(n, function(e, n) {
      t = t.replace(new RegExp("\\{" + e + "\\}", "g"), function() {
        return n
      })
    }), t)
  }, e.extend(e.validator, {
    defaults: {
      messages: {},
      groups: {},
      rules: {},
      errorClass: "error",
      validClass: "valid",
      errorElement: "label",
      focusInvalid: !0,
      errorContainer: e([]),
      errorLabelContainer: e([]),
      onsubmit: !0,
      ignore: ":hidden",
      ignoreTitle: !1,
      onfocusin: function(e, t) {
        this.lastActive = e, this.settings.focusCleanup && !this.blockFocusCleanup && (this.settings.unhighlight && this.settings.unhighlight.call(this, e, this.settings.errorClass, this.settings.validClass), this.addWrapper(this.errorsFor(e)).hide())
      },
      onfocusout: function(e, t) {
        !this.checkable(e) && (e.name in this.submitted || !this.optional(e)) && this.element(e)
      },
      onkeyup: function(e, t) {
        if(t.which === 9 && this.elementValue(e) === "") return;
        (e.name in this.submitted || e === this.lastElement) && this.element(e)
      },
      onclick: function(e, t) {
        e.name in this.submitted ? this.element(e) : e.parentNode.name in this.submitted && this.element(e.parentNode)
      },
      highlight: function(t, n, r) {
        t.type === "radio" ? this.findByName(t.name).addClass(n).removeClass(r) : e(t).addClass(n).removeClass(r)
      },
      unhighlight: function(t, n, r) {
        t.type === "radio" ? this.findByName(t.name).removeClass(n).addClass(r) : e(t).removeClass(n).addClass(r)
      }
    },
    setDefaults: function(t) {
      e.extend(e.validator.defaults, t)
    },
    messages: {
      required: "This field is required.",
      remote: "Please fix this field.",
      email: "Please enter a valid email address.",
      url: "Please enter a valid URL.",
      date: "Please enter a valid date.",
      dateISO: "Please enter a valid date (ISO).",
      number: "Please enter a valid number.",
      digits: "Please enter only digits.",
      creditcard: "Please enter a valid credit card number.",
      equalTo: "Please enter the same value again.",
      maxlength: e.validator.format("Please enter no more than {0} characters."),
      minlength: e.validator.format("Please enter at least {0} characters."),
      rangelength: e.validator.format("Please enter a value between {0} and {1} characters long."),
      range: e.validator.format("Please enter a value between {0} and {1}."),
      max: e.validator.format("Please enter a value less than or equal to {0}."),
      min: e.validator.format("Please enter a value greater than or equal to {0}.")
    },
    autoCreateRanges: !1,
    prototype: {
      init: function() {
        function r(t) {
          var n = e.data(this[0].form, "validator"),
            r = "on" + t.type.replace(/^validate/, "");
          n.settings[r] && n.settings[r].call(n, this[0], t)
        }
        this.labelContainer = e(this.settings.errorLabelContainer), this.errorContext = this.labelContainer.length && this.labelContainer || e(this.currentForm), this.containers = e(this.settings.errorContainer).add(this.settings.errorLabelContainer), this.submitted = {}, this.valueCache = {}, this.pendingRequest = 0, this.pending = {}, this.invalid = {}, this.reset();
        var t = this.groups = {};
        e.each(this.settings.groups, function(n, r) {
          typeof r == "string" && (r = r.split(/\s/)), e.each(r, function(e, r) {
            t[r] = n
          })
        });
        var n = this.settings.rules;
        e.each(n, function(t, r) {
          n[t] = e.validator.normalizeRule(r)
        }), e(this.currentForm).validateDelegate(":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'] ", "focusin focusout keyup", r).validateDelegate("[type='radio'], [type='checkbox'], select, option", "click", r), this.settings.invalidHandler && e(this.currentForm).bind("invalid-form.validate", this.settings.invalidHandler)
      },
      form: function() {
        return this.checkForm(), e.extend(this.submitted, this.errorMap), this.invalid = e.extend({}, this.errorMap), this.valid() || e(this.currentForm).triggerHandler("invalid-form", [this]), this.showErrors(), this.valid()
      },
      checkForm: function() {
        this.prepareForm();
        for(var e = 0, t = this.currentElements = this.elements(); t[e]; e++) this.check(t[e]);
        return this.valid()
      },
      element: function(t) {
        t = this.validationTargetFor(this.clean(t)), this.lastElement = t, this.prepareElement(t), this.currentElements = e(t);
        var n = this.check(t) !== !1;
        return n ? delete this.invalid[t.name] : this.invalid[t.name] = !0, this.numberOfInvalids() || (this.toHide = this.toHide.add(this.containers)), this.showErrors(), n
      },
      showErrors: function(t) {
        if(t) {
          e.extend(this.errorMap, t), this.errorList = [];
          for(var n in t) this.errorList.push({
            message: t[n],
            element: this.findByName(n)[0]
          });
          this.successList = e.grep(this.successList, function(e) {
            return !(e.name in t)
          })
        }
        this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors()
      },
      resetForm: function() {
        e.fn.resetForm && e(this.currentForm).resetForm(), this.submitted = {}, this.lastElement = null, this.prepareForm(), this.hideErrors(), this.elements().removeClass(this.settings.errorClass).removeData("previousValue")
      },
      numberOfInvalids: function() {
        return this.objectLength(this.invalid)
      },
      objectLength: function(e) {
        var t = 0;
        for(var n in e) t++;
        return t
      },
      hideErrors: function() {
        this.addWrapper(this.toHide).hide()
      },
      valid: function() {
        return this.size() === 0
      },
      size: function() {
        return this.errorList.length
      },
      focusInvalid: function() {
        if(this.settings.focusInvalid) try {
          e(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin")
        } catch(t) {}
      },
      findLastActive: function() {
        var t = this.lastActive;
        return t && e.grep(this.errorList, function(e) {
          return e.element.name === t.name
        }).length === 1 && t
      },
      elements: function() {
        var t = this,
          n = {};
        return e(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function() {
          return !this.name && t.settings.debug && window.console && console.error("%o has no name assigned", this), this.name in n || !t.objectLength(e(this).rules()) ? !1 : (n[this.name] = !0, !0)
        })
      },
      clean: function(t) {
        return e(t)[0]
      },
      errors: function() {
        var t = this.settings.errorClass.replace(" ", ".");
        return e(this.settings.errorElement + "." + t, this.errorContext)
      },
      reset: function() {
        this.successList = [], this.errorList = [], this.errorMap = {}, this.toShow = e([]), this.toHide = e([]), this.currentElements = e([])
      },
      prepareForm: function() {
        this.reset(), this.toHide = this.errors().add(this.containers)
      },
      prepareElement: function(e) {
        this.reset(), this.toHide = this.errorsFor(e)
      },
      elementValue: function(t) {
        var n = e(t).attr("type"),
          r = e(t).val();
        return n === "radio" || n === "checkbox" ? e("input[name='" + e(t).attr("name") + "']:checked").val() : typeof r == "string" ? r.replace(/\r/g, "") : r
      },
      check: function(t) {
        t = this.validationTargetFor(this.clean(t));
        var n = e(t).rules(),
          r = !1,
          i = this.elementValue(t),
          s;
        for(var o in n) {
          var u = {
            method: o,
            parameters: n[o]
          };
          try {
            s = e.validator.methods[o].call(this, i, t, u.parameters);
            if(s === "dependency-mismatch") {
              r = !0;
              continue
            }
            r = !1;
            if(s === "pending") {
              this.toHide = this.toHide.not(this.errorsFor(t));
              return
            }
            if(!s) return this.formatAndAdd(t, u), !1
          } catch(a) {
            throw this.settings.debug && window.console && console.log("Exception occured when checking element " + t.id + ", check the '" + u.method + "' method.", a), a
          }
        }
        if(r) return;
        return this.objectLength(n) && this.successList.push(t), !0
      },
      customDataMessage: function(t, n) {
        return e(t).data("msg-" + n.toLowerCase()) || t.attributes && e(t).attr("data-msg-" + n.toLowerCase())
      },
      customMessage: function(e, t) {
        var n = this.settings.messages[e];
        return n && (n.constructor === String ? n : n[t])
      },
      findDefined: function() {
        for(var e = 0; e < arguments.length; e++) if(arguments[e] !== undefined) return arguments[e];
        return undefined
      },
      defaultMessage: function(t, n) {
        return this.findDefined(this.customMessage(t.name, n), this.customDataMessage(t, n), !this.settings.ignoreTitle && t.title || undefined, e.validator.messages[n], "<strong>Warning: No message defined for " + t.name + "</strong>")
      },
      formatAndAdd: function(t, n) {
        var r = this.defaultMessage(t, n.method),
          i = /\$?\{(\d+)\}/g;
        typeof r == "function" ? r = r.call(this, n.parameters, t) : i.test(r) && (r = e.validator.format(r.replace(i, "{$1}"), n.parameters)), this.errorList.push({
          message: r,
          element: t
        }), this.errorMap[t.name] = r, this.submitted[t.name] = r
      },
      addWrapper: function(e) {
        return this.settings.wrapper && (e = e.add(e.parent(this.settings.wrapper))), e
      },
      defaultShowErrors: function() {
        var e, t;
        for(e = 0; this.errorList[e]; e++) {
          var n = this.errorList[e];
          this.settings.highlight && this.settings.highlight.call(this, n.element, this.settings.errorClass, this.settings.validClass), this.showLabel(n.element, n.message)
        }
        this.errorList.length && (this.toShow = this.toShow.add(this.containers));
        if(this.settings.success) for(e = 0; this.successList[e]; e++) this.showLabel(this.successList[e]);
        if(this.settings.unhighlight) for(e = 0, t = this.validElements(); t[e]; e++) this.settings.unhighlight.call(this, t[e], this.settings.errorClass, this.settings.validClass);
        this.toHide = this.toHide.not(this.toShow), this.hideErrors(), this.addWrapper(this.toShow).show()
      },
      validElements: function() {
        return this.currentElements.not(this.invalidElements())
      },
      invalidElements: function() {
        return e(this.errorList).map(function() {
          return this.element
        })
      },
      showLabel: function(t, n) {
        var r = this.errorsFor(t);
        r.length ? (r.removeClass(this.settings.validClass).addClass(this.settings.errorClass), r.html(n)) : (r = e("<" + this.settings.errorElement + ">").attr("for", this.idOrName(t)).addClass(this.settings.errorClass).html(n || ""), this.settings.wrapper && (r = r.hide().show().wrap("<" + this.settings.wrapper + "/>").parent()), this.labelContainer.append(r).length || (this.settings.errorPlacement ? this.settings.errorPlacement(r, e(t)) : r.insertAfter(t))), !n && this.settings.success && (r.text(""), typeof this.settings.success == "string" ? r.addClass(this.settings.success) : this.settings.success(r, t)), this.toShow = this.toShow.add(r)
      },
      errorsFor: function(t) {
        var n = this.idOrName(t);
        return this.errors().filter(function() {
          return e(this).attr("for") === n
        })
      },
      idOrName: function(e) {
        return this.groups[e.name] || (this.checkable(e) ? e.name : e.id || e.name)
      },
      validationTargetFor: function(e) {
        return this.checkable(e) && (e = this.findByName(e.name).not(this.settings.ignore)[0]), e
      },
      checkable: function(e) {
        return /radio|checkbox/i.test(e.type)
      },
      findByName: function(t) {
        return e(this.currentForm).find("[name='" + t + "']")
      },
      getLength: function(t, n) {
        switch(n.nodeName.toLowerCase()) {
        case "select":
          return e("option:selected", n).length;
        case "input":
          if(this.checkable(n)) return this.findByName(n.name).filter(":checked").length
        }
        return t.length
      },
      depend: function(e, t) {
        return this.dependTypes[typeof e] ? this.dependTypes[typeof e](e, t) : !0
      },
      dependTypes: {
        "boolean": function(e, t) {
          return e
        },
        string: function(t, n) {
          return !!e(t, n.form).length
        },
        "function": function(e, t) {
          return e(t)
        }
      },
      optional: function(t) {
        var n = this.elementValue(t);
        return !e.validator.methods.required.call(this, n, t) && "dependency-mismatch"
      },
      startRequest: function(e) {
        this.pending[e.name] || (this.pendingRequest++, this.pending[e.name] = !0)
      },
      stopRequest: function(t, n) {
        this.pendingRequest--, this.pendingRequest < 0 && (this.pendingRequest = 0), delete this.pending[t.name], n && this.pendingRequest === 0 && this.formSubmitted && this.form() ? (e(this.currentForm).submit(), this.formSubmitted = !1) : !n && this.pendingRequest === 0 && this.formSubmitted && (e(this.currentForm).triggerHandler("invalid-form", [this]), this.formSubmitted = !1)
      },
      previousValue: function(t) {
        return e.data(t, "previousValue") || e.data(t, "previousValue", {
          old: null,
          valid: !0,
          message: this.defaultMessage(t, "remote")
        })
      }
    },
    classRuleSettings: {
      required: {
        required: !0
      },
      email: {
        email: !0
      },
      url: {
        url: !0
      },
      date: {
        date: !0
      },
      dateISO: {
        dateISO: !0
      },
      number: {
        number: !0
      },
      digits: {
        digits: !0
      },
      creditcard: {
        creditcard: !0
      }
    },
    addClassRules: function(t, n) {
      t.constructor === String ? this.classRuleSettings[t] = n : e.extend(this.classRuleSettings, t)
    },
    classRules: function(t) {
      var n = {}, r = e(t).attr("class");
      return r && e.each(r.split(" "), function() {
        this in e.validator.classRuleSettings && e.extend(n, e.validator.classRuleSettings[this])
      }), n
    },
    attributeRules: function(t) {
      var n = {}, r = e(t);
      for(var i in e.validator.methods) {
        var s;
        i === "required" ? (s = r.get(0).getAttribute(i), s === "" && (s = !0), s = !! s) : s = r.attr(i), s ? n[i] = s : r[0].getAttribute("type") === i && (n[i] = !0)
      }
      return n.maxlength && /-1|2147483647|524288/.test(n.maxlength) && delete n.maxlength, n
    },
    dataRules: function(t) {
      var n, r, i = {}, s = e(t);
      for(n in e.validator.methods) r = s.data("rule-" + n.toLowerCase()), r !== undefined && (i[n] = r);
      return i
    },
    staticRules: function(t) {
      var n = {}, r = e.data(t.form, "validator");
      return r.settings.rules && (n = e.validator.normalizeRule(r.settings.rules[t.name]) || {}), n
    },
    normalizeRules: function(t, n) {
      return e.each(t, function(r, i) {
        if(i === !1) {
          delete t[r];
          return
        }
        if(i.param || i.depends) {
          var s = !0;
          switch(typeof i.depends) {
          case "string":
            s = !! e(i.depends, n.form).length;
            break;
          case "function":
            s = i.depends.call(n, n)
          }
          s ? t[r] = i.param !== undefined ? i.param : !0 : delete t[r]
        }
      }), e.each(t, function(r, i) {
        t[r] = e.isFunction(i) ? i(n) : i
      }), e.each(["minlength", "maxlength"], function() {
        t[this] && (t[this] = Number(t[this]))
      }), e.each(["rangelength"], function() {
        var n;
        t[this] && (e.isArray(t[this]) ? t[this] = [Number(t[this][0]), Number(t[this][1])] : typeof t[this] == "string" && (n = t[this].split(/[\s,]+/), t[this] = [Number(n[0]), Number(n[1])]))
      }), e.validator.autoCreateRanges && (t.min && t.max && (t.range = [t.min, t.max], delete t.min, delete t.max), t.minlength && t.maxlength && (t.rangelength = [t.minlength, t.maxlength], delete t.minlength, delete t.maxlength)), t
    },
    normalizeRule: function(t) {
      if(typeof t == "string") {
        var n = {};
        e.each(t.split(/\s/), function() {
          n[this] = !0
        }), t = n
      }
      return t
    },
    addMethod: function(t, n, r) {
      e.validator.methods[t] = n, e.validator.messages[t] = r !== undefined ? r : e.validator.messages[t], n.length < 3 && e.validator.addClassRules(t, e.validator.normalizeRule(t))
    },
    methods: {
      required: function(t, n, r) {
        if(!this.depend(r, n)) return "dependency-mismatch";
        if(n.nodeName.toLowerCase() === "select") {
          var i = e(n).val();
          return i && i.length > 0
        }
        return this.checkable(n) ? this.getLength(t, n) > 0 : e.trim(t).length > 0
      },
      remote: function(t, n, r) {
        if(this.optional(n)) return "dependency-mismatch";
        var i = this.previousValue(n);
        this.settings.messages[n.name] || (this.settings.messages[n.name] = {}), i.originalMessage = this.settings.messages[n.name].remote, this.settings.messages[n.name].remote = i.message, r = typeof r == "string" && {
          url: r
        } || r;
        if(i.old === t) return i.valid;
        i.old = t;
        var s = this;
        this.startRequest(n);
        var o = {};
        return o[n.name] = t, e.ajax(e.extend(!0, {
          url: r,
          mode: "abort",
          port: "validate" + n.name,
          dataType: "json",
          data: o,
          success: function(r) {
            s.settings.messages[n.name].remote = i.originalMessage;
            var o = r === !0 || r === "true";
            if(o) {
              var u = s.formSubmitted;
              s.prepareElement(n), s.formSubmitted = u, s.successList.push(n), delete s.invalid[n.name], s.showErrors()
            } else {
              var a = {}, f = r || s.defaultMessage(n, "remote");
              a[n.name] = i.message = e.isFunction(f) ? f(t) : f, s.invalid[n.name] = !0, s.showErrors(a)
            }
            i.valid = o, s.stopRequest(n, o)
          }
        }, r)), "pending"
      },
      minlength: function(t, n, r) {
        var i = e.isArray(t) ? t.length : this.getLength(e.trim(t), n);
        return this.optional(n) || i >= r
      },
      maxlength: function(t, n, r) {
        var i = e.isArray(t) ? t.length : this.getLength(e.trim(t), n);
        return this.optional(n) || i <= r
      },
      rangelength: function(t, n, r) {
        var i = e.isArray(t) ? t.length : this.getLength(e.trim(t), n);
        return this.optional(n) || i >= r[0] && i <= r[1]
      },
      min: function(e, t, n) {
        return this.optional(t) || e >= n
      },
      max: function(e, t, n) {
        return this.optional(t) || e <= n
      },
      range: function(e, t, n) {
        return this.optional(t) || e >= n[0] && e <= n[1]
      },
      email: function(e, t) {
        return this.optional(t) || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(e)
      },
      url: function(e, t) {
        return this.optional(t) || /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(e)
      },
      date: function(e, t) {
        return this.optional(t) || !/Invalid|NaN/.test((new Date(e)).toString())
      },
      dateISO: function(e, t) {
        return this.optional(t) || /^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}$/.test(e)
      },
      number: function(e, t) {
        return this.optional(t) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(e)
      },
      digits: function(e, t) {
        return this.optional(t) || /^\d+$/.test(e)
      },
      creditcard: function(e, t) {
        if(this.optional(t)) return "dependency-mismatch";
        if(/[^0-9 \-]+/.test(e)) return !1;
        var n = 0,
          r = 0,
          i = !1;
        e = e.replace(/\D/g, "");
        for(var s = e.length - 1; s >= 0; s--) {
          var o = e.charAt(s);
          r = parseInt(o, 10), i && (r *= 2) > 9 && (r -= 9), n += r, i = !i
        }
        return n % 10 === 0
      },
      equalTo: function(t, n, r) {
        var i = e(r);
        return this.settings.onfocusout && i.unbind(".validate-equalTo").bind("blur.validate-equalTo", function() {
          e(n).valid()
        }), t === i.val()
      }
    }
  }), e.format = e.validator.format
}(jQuery),
function(e) {
  var t = {};
  if(e.ajaxPrefilter) e.ajaxPrefilter(function(e, n, r) {
    var i = e.port;
    e.mode === "abort" && (t[i] && t[i].abort(), t[i] = r)
  });
  else {
    var n = e.ajax;
    e.ajax = function(r) {
      var i = ("mode" in r ? r : e.ajaxSettings).mode,
        s = ("port" in r ? r : e.ajaxSettings).port;
      return i === "abort" ? (t[s] && t[s].abort(), t[s] = n.apply(this, arguments)) : n.apply(this, arguments)
    }
  }
}(jQuery),
function(e) {
  e.extend(e.fn, {
    validateDelegate: function(t, n, r) {
      return this.bind(n, function(n) {
        var i = e(n.target);
        if(i.is(t)) return r.apply(i, arguments)
      })
    }
  })
}(jQuery),
function(e) {
  var t = {
    className: "autosizejs",
    append: "",
    callback: !1
  }, n = "hidden",
    r = "border-box",
    i = "lineHeight",
    s = '<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden;"/>',
    o = ["fontFamily", "fontSize", "fontWeight", "fontStyle", "letterSpacing", "textTransform", "wordSpacing", "textIndent"],
    u = "oninput",
    a = "onpropertychange",
    f, l = e(s).data("autosize", !0)[0];
  l.style.lineHeight = "99px", e(l).css(i) === "99px" && o.push(i), l.style.lineHeight = "", e.fn.autosize = function(i) {
    return i = e.extend({}, t, i || {}), l.parentNode !== document.body && e(document.body).append(l), this.each(function() {
      function m() {
        f = t, l.className = i.className, e.each(o, function(e, t) {
          l.style[t] = s.css(t)
        })
      }
      function g() {
        var e, r, o;
        f !== t && m();
        if(!h) {
          h = !0, l.value = t.value + i.append, l.style.overflowY = t.style.overflowY, o = parseInt(t.style.height, 10), l.style.width = Math.max(s.width(), 0) + "px", l.scrollTop = 0, l.scrollTop = 9e4, e = l.scrollTop;
          var u = parseInt(s.css("maxHeight"), 10);
          u = u && u > 0 ? u : 9e4, e > u ? (e = u, r = "scroll") : e < c && (e = c), e += d, t.style.overflowY = r || n, o !== e && (t.style.height = e + "px", v && i.callback.call(t)), setTimeout(function() {
            h = !1
          }, 1)
        }
      }
      var t = this,
        s = e(t),
        c, h, p, d = 0,
        v = e.isFunction(i.callback);
      if(s.data("autosize")) return;
      if(s.css("box-sizing") === r || s.css("-moz-box-sizing") === r || s.css("-webkit-box-sizing") === r) d = s.outerHeight() - s.height();
      c = Math.max(parseInt(s.css("minHeight"), 10) - d, s.height()), p = s.css("resize") === "none" || s.css("resize") === "vertical" ? "none" : "horizontal", s.css({
        overflow: n,
        overflowY: n,
        wordWrap: "break-word",
        resize: p
      }).data("autosize", !0), a in t ? u in t ? t[u] = t.onkeyup = g : t[a] = g : t[u] = g, e(window).resize(g), s.bind("autosize", g), g()
    })
  }
}(window.jQuery || window.Zepto), $("#purchase-dropdown button.submit-button").click(function() {
  return $(this).parents("#purchase-dropdown").find("[name=licence]").val($(this).val()), $(this).parents("#purchase-dropdown").find("span.licence-name").text($(this).attr("name")), !1
}), $("div.pricebox h3.js-closed").css({
  height: "0px"
}), $("div.pricebox h3").click(function() {
  var e = $(this),
    t = $(this).parent(),
    n = e.parent().find(".js-open"),
    r = 250,
    i = {
      height: "toggle"
    }, s;
  t.find(".js-active").animate(i, r), t.find(".js-active").removeClass("js-active"), e.animate(i, r), e.addClass("js-active"), e.next(".js-closed").animate(i, r), e.next(".js-closed").removeClass("js-closed").addClass("js-open"), n.animate(i, r), n.addClass("js-closed").removeClass("js-open"), s = $(".js-open .price_in_dollars:first").attr("data-licence"), choose_licence(s)
}), $(".sizes tr").click(function(e) {
  $(this).parents("table").find(".selected").removeClass("selected"), $(this).addClass("selected"), $("input", $(this)).attr("checked", "checked"), choose_purchasable($(this).attr("data-accessor"))
}), $("div.fancy-purchase-panel input[type=submit]").remove();
var animatePanel = function(e) {
  var t = e ? e : "show";
  $("div.fancy-purchase-panel, div.account-required.panel").animate({
    height: t,
    opacity: t,
    marginBottom: t
  }, "slow")
};
$("#purchase-form").submit(function() {
  return animatePanel(), !1
}), $("#purchase-form > button").click(function(e) {
  return e.preventDefault(), animatePanel(), !1
}), $("div.fancy-purchase-panel a.close-panel, div.account-required.panel a.close-panel").click(function() {
  return animatePanel("hide"), !1
}), $("a.buynow-submit").click(function() {
  return submit_purchase_form(this), !1
}), $("a.prepaid-submit").click(function() {
  return confirm_purchase($("#stored-item-name").val(), $("#stored-item-category").val()) && submit_purchase_form(this), !1
}),
function() {
  var e = document.getElementById("term");
  $("#search").on("submit", function(t) {
    e.value === "" && (t.preventDefault(), e.focus())
  })
}();
var SiteSwitcher = function() {
  var e, t, n;
  e = $(window).width(), t = $(window).height(), n = $("<div class='trans'></div>"), n.css("height", t), n.css("width", e), n.hide(), $("#marketplace-switcher").click(function() {
    $("#marketplace-panel").show(), n.css("width", $(document).width()), n.css("height", $(window).height()), n.show()
  }), n.click(function() {
    $("#marketplace-panel").hide(), n.hide()
  }), $("body").append(n)
};
$(document).ready(function() {
  var e = new SiteSwitcher
}), $(document).ready(function() {
  $("form.fancy-form").jqTransform(), $("#footer #mc-embedded-subscribe-form").newsletterForm(), $("form.item-form").itemForm(), $("form.disable-on-submit").disableOnSubmit()
}), $.fn.jqTransformReApply = function() {
  $(this).each(function() {
    $(this).removeClass("jqtransformdone"), $(this).jqTransform()
  })
}, $.fn.itemForm = function() {
  return $(this).each(function() {
    var e = this;
    e.notApplicableCheckboxChanged = function() {
      var e = $(":input[type!='checkbox']", $(this).parent());
      $(this)[0].checked ? (e.attr("disabled", "disabled"), e.addClass("disabled")) : (e.removeAttr("disabled"), e.removeClass("disabled"))
    }, e.radioChanged = function(e, t) {
      $(e).hasClass("radio-with-text") ? (t.removeAttr("disabled"), t.removeClass("disabled")) : (t.attr("disabled", "true"), t.addClass("disabled").removeClass("invalid").val(""), t.parent().find("label.invalid").remove())
    }, e.initialize = function() {
      $(".item-attribute-not-applicable-checkbox", e).change(e.notApplicableCheckboxChanged).each(e.notApplicableCheckboxChanged), $(".radio-combo", e).each(function() {
        var t = this,
          n = $(":text.radio-with-text", t);
        $(":radio", t).change(function() {
          e.radioChanged(this, n)
        }), $(":radio.radio-with-text", e).is(":checked") || (n.attr("disabled", "disabled"), n.addClass("disabled"))
      })
    }, e.initialize()
  }), this
}, $.fn.newsletterForm = function() {
  var e = this;
  $("input.email", e).focus(function() {
    $.trim($(this).val()) === "Email Address" && $(this).val("")
  }), $("input.fname", e).focus(function() {
    $.trim($(this).val()) === "First Name" && $(this).val("")
  }), $("input.lname", e).focus(function() {
    $.trim($(this).val()) === "Last Name" && $(this).val("")
  }), $("input.email", e).blur(function() {
    $.trim($(this).val()) === "" && $(this).val("Email Address")
  }), $("input.fname", e).blur(function() {
    $.trim($(this).val()) === "" && $(this).val("First Name")
  }), $("input.lname", e).blur(function() {
    $.trim($(this).val()) === "" && $(this).val("Last Name")
  })
}, $.fn.validateWithTooltip = function(e, t) {
  var n = $(this),
    r, i, s = 140,
    o, u, a, f, l;
  return r = $('<div class="validation-tooltip" style="display: none"></div>'), a = function() {
    n.css({
      "-webkit-box-shadow": "none",
      "-moz-box-shadow": "none",
      "box-shadow": "none",
      borderColor: "#b2b2b2"
    })
  }, f = function() {
    r.fadeOut(s, function() {
      r.css({
        "margin-left": "0px"
      })
    })
  }, l = function(i) {
    n.val() !== "" ? e(n.val()) ? (n.css({
      "-webkit-box-shadow": "none",
      "-moz-box-shadow": "none",
      "box-shadow": "none",
      borderColor: "#b2b2b2"
    }), f()) : o = setTimeout(function() {
      r.is(":visible") || (r.text(t), r.insertAfter(n), r.css({
        visibility: "hidden"
      }), r.show(), u = r.offset().left, r.hide(), r.css({
        visibility: "visible"
      }), r.css({
        "margin-left": n.offset().left - u + "px"
      }), r.fadeIn(s)), n.animate({
        "-webkit-box-shadow": "0px 0px 3px #F99",
        "-moz-box-shadow": "0px 0px 3px #F99",
        "box-shadow": "0px 0px 3px #F99",
        borderColor: "#FF9999"
      }, s)
    }, i) : (a(), f())
  }, $(document).ready(function() {
    l(0)
  }), n.keyup(function() {
    o && (clearTimeout(o), o = undefined), l(300)
  }), n.focus(function() {
    l(0)
  }), n.blur(function() {
    f()
  }), n.bind("disabled", function() {
    a(), f()
  }), n.bind("enabled", function() {
    l(0)
  }), n
}, $.fn.validateWithRegex = function(e, t) {
  $(this).validateWithTooltip(function(t) {
    return t.match(e)
  }, t)
}, $.fn.displayButtonAsLink = function(e) {
  var t = $(this),
    n = t.closest("form"),
    r = $(document.createElement("a")),
    i = $.extend({
      href: "#"
    }, e);
  n.addClass("hidden"), r.attr(i).html(t.html()).insertAfter(n[0]).click(function(e) {
    e.preventDefault(), t[0].form.submit()
  })
};
var MiniPlayer = function(e) {
  var t, n = null;
  return {
    removeImg: function(t) {
      return e(t).find("img").remove(), !0
    },
    removeSWF: function(t) {
      e(t).find("object").remove()
    },
    addSWF: function(t) {
      e(t).find("object").length === 0 && (this.removeSWF(n), e(t).flash({
        swf: "/flash/small_aj_preview.swf",
        height: 21,
        width: 70,
        flashvars: {
          songUrl: this.getMp3Url(t),
          looping: !1,
          autoplay: !1
        }
      }), n = t)
    },
    getMp3Url: function(t) {
      return this.mp3Url = e(t).attr("href"), this.mp3Url
    }
  }
}(jQuery);
$(document).ready(bindAudioPlayerClickEvent), $(window).unload(function() {
  $(".audio_player object").each(function() {
    MiniPlayer.removeSWF($(this).parent())
  })
}), marketplace.ItemPreview = function(e) {
  var t = this;
  return t.config = e, t.previewTypes = {
    audio_lightbox: function(e) {
      $(".audio").fancybox({
        width: 590,
        height: 300,
        model: !1,
        autoDimensions: !1,
        padding: 12,
        type: "swf",
        swf: {
          width: 590,
          height: 300,
          wmode: "#000000",
          flashvars: "soundFileName=" + e.preview_url + "&useDl=" + e.downloadable + "&soundLength=" + e.filelength,
          params: "allowScriptAccess=sameDomain&movie='/flash/" + e.marketplace + "_preview.swf&wmode=opaque"
        }
      })
    },
    video: function(e) {
      var n = e.height > 540 ? 540 : e.height,
        r = e.width > 960 ? 960 : e.width,
        i = "file=" + encodeURIComponent(e.preview_url) + "&image=" + encodeURIComponent(e.image_url) + "&skin=" + encodeURIComponent("http://videohive.net/video_player/modieus.zip");
      t.hasFlash ? $(".video-preview, .video-preview-image").fancybox({
        width: r,
        height: n,
        model: !1,
        autoDimensions: !1,
        padding: 12,
        content: '<div id="video-container"></div>',
        hideOnContentClick: !1,
        scrolling: "no",
        onComplete: function() {
          jwplayer("video-container").setup({
            autostart: !0,
            flashplayer: "/video_player/player.swf",
            file: e.preview_url,
            height: n,
            image: e.mp_placeholder,
            plugins: {
              "sharing-3": {
                code: encodeURI("<embed width='" + r + "' height='" + n + "' flashvars='" + i + "' wmode='transparent' src='http://videohive.net/video_player/player.swf' />")
              }
            },
            repeat: "always",
            skin: "/video_player/modieus.zip",
            width: r
          })
        },
        onCleanup: function() {
          try {
            jwplayer("video-container").remove()
          } catch(e) {}
        }
      }) : ($(".flash-warning").removeClass("hidden"), $(".video-preview, .video-preview-image").on("click", function(e) {
        e.preventDefault()
      }))
    },
    flash: function(e) {
      var t, n, r;
      t = {}, n = {
        base: e.base,
        wmode: "opaque"
      }, r = {}, swfobject.embedSWF(e.preview_url, "large_item_preview_container", "590", "300", "9.0.0", "/swfobject/expressInstall.swf", t, n, r)
    },
    audio: function(e) {
      var t, n, r;
      t = {
        soundFileName: e.preview_url,
        useDl: e.downloadable,
        soundLength: e.filelength
      }, n = {
        allowScriptAccess: "sameDomain",
        movie: "/flash/" + e.marketplace + "_preview.swf",
        wmode: "opaque"
      }, r = {}, swfobject.embedSWF("/flash/" + e.marketplace + "_preview.swf", "large_item_preview_container", "590", "300", "9.0.0", "/swfobject/expressInstall.swf", t, n, r)
    }
  }, t.client_has_flash = function() {
    var e, t, n, r, i, s;
    return swfobject.hasFlashPlayerVersion("8.0.0") ? !0 : (r = $("<h4>Loading Item Preview...</h4>"), i = $("<p>If you are reading this message you may not have Adobe Flash installed or you are required to upgrade your Flash player.</p>"), s = $('<p>You can download a copy of Adobe Flash from <a href="http://get.adobe.com/flashplayer/">here</a></p>'), $("#large_item_preview_container").append(r).append(i).append(s), !1)
  }, t.initialize = function() {
    t.hasFlash = t.client_has_flash(), t.previewTypes[t.config.type] === undefined && (t.config.type = "unknown")
  }, t.display = function() {
    t.hasFlash || $(document.documentElement).addClass("no-flash");
    var e = t.previewTypes[t.config.type];
    typeof e != "undefined" ? e(t.config) : alert("Item preview type not defined.")
  }, t.initialize(), t
};
var Magnifier = {
  price_prefix: "",
  positionMagnifierNextTo: function(e) {
    var t, n, r;
    t = this.magnifierDiv(), n = $(e).offset().top + $(e).outerHeight() - t.outerHeight(), n < $(window).scrollTop() && (n = $(window).scrollTop()), $(e).offset().left + $(e).outerWidth() / 2 >= $(window).width() / 2 ? r = $(e).offset().left - t.outerWidth() : r = $(e).offset().left + $(e).outerWidth(), t.css({
      top: n,
      left: r
    })
  },
  showMagnifier: function(e) {
    $(e).attr("data-tooltip") === undefined && ($(e).attr("data-tooltip", $(e).attr("title")), $(e).attr("title", ""), $("img", e).attr("title", "")), this.populateMagnifierFrom(e), this.positionMagnifierNextTo(e), this.magnifierDiv().css({
      display: "inline"
    })
  },
  hideMagnifier: function() {
    this.magnifierDiv().hide()
  },
  magnify: function(e) {
    var t = this;
    $(e).live("mouseenter", function() {
      t.showMagnifier(this)
    }), $(e).live("mouseleave", function() {
      t.hideMagnifier(this)
    })
  },
  bindMetaData: function(e) {
    var t = $(e),
      n = this.magnifierDiv(),
      r, i, s = n.find("strong").empty(),
      o = n.find(".author").empty(),
      u = n.find(".category").empty(),
      a = n.find(".cost").empty(),
      f = n.find(".info");
    i = t.attr("data-item-cost"), r = typeof $(e).attr("data-item-cost") != "undefined", s.html(t.attr("data-item-name")), o.html(t.attr("data-item-author")), u.html(t.attr("data-item-category")), a.html(r ? this.price_prefix + i : i)
  }
}, TooltipMagnifier = objectWithPrototype(Magnifier, {
  magnifierDiv: function() {
    return $("div#tooltip-magnifier")
  },
  populateMagnifierFrom: function(e) {
    this.bindMetaData(e)
  }
}),
  ImageMagnifier = objectWithPrototype(Magnifier, {
    populateMagnifierFrom: function(e) {
      var t, n = this.magnifierDiv(),
        r = n.find("div.size-limiter"),
        i = $(e);
      i.attr("data-preview-url") ? (t = new Image, $(t).attr("src", i.attr("data-preview-url")), i.attr("data-preview-height") && ($(t).attr("height", 350), $(t).attr("width", 350 / i.attr("data-preview-height") * i.attr("data-preview-width"))), r.empty(), r.append(t), r.show()) : r.hide(), this.bindMetaData(e)
    }
  }),
  LandscapeImageMagnifier = objectWithPrototype(ImageMagnifier, {
    magnifierDiv: function() {
      return $("div#landscape-image-magnifier")
    }
  }),
  SquareImageMagnifier = objectWithPrototype(ImageMagnifier, {
    magnifierDiv: function() {
      return $("div#square-image-magnifier")
    }
  }),
  SmartImageMagnifier = objectWithPrototype(ImageMagnifier, {
    magnifierDiv: function() {
      return $("div#smart-image-magnifier")
    },
    populateMagnifierFrom: function(e) {
      var t, n, r, i, s, o, u = this.magnifierDiv(),
        a = u.find("div.size-limiter").empty(),
        f = u.find("strong");
      t = new Image, $(t).attr("src", $(e).attr("data-preview-url")), n = parseInt($(e).attr("data-preview-height"), 10), r = parseInt($(e).attr("data-preview-width"), 10), $(a).empty(), $(a).css("height", ""), $(a).css("width", ""), $(u).removeClass("previewable"), n * r > 0 ? (n > r ? (i = 350, s = 350 / n * r) : (s = 350, i = 350 / r * n), $(t).attr("height", i), $(t).attr("width", s), f.css("width", s), u.css("width", s), $(a).css("height", i), $(a).css("width", s), $(e).hasClass("no_preview") || ($(u).addClass("previewable"), o = $(e).clone(), o.addClass("thumbnail_preview").attr("width", s).attr("height", i), $(a).append(o)), $(a).show()) : $(t).attr("height", 225), $(a).append(t), this.bindMetaData(e)
    }
  }),
  PortraitImageMagnifier = objectWithPrototype(ImageMagnifier, {
    magnifierDiv: function() {
      return $("div#portrait-image-magnifier")
    }
  });
$(function() {
  TooltipMagnifier.magnify(".tooltip-magnifier"), LandscapeImageMagnifier.magnify("img.landscape-image-magnifier"), SquareImageMagnifier.magnify("img.square-image-magnifier"), SmartImageMagnifier.magnify("img.smart-image-magnifier"), PortraitImageMagnifier.magnify("img.portrait-image-magnifier")
}), $(document).ready(function() {
  $("#recent-files.with-category-switcher").each(function() {
    $(this).homepageRecentItems()
  })
}), $.fn.homepageRecentItems = function() {
  var e = this;
  e.initialize = function() {
    e.list = $("ul.recent-items", e), e.loader = $(".loading", e), e.switchers = $("a.category-switcher", e), e.categoryLinks = $(".category-links", e), e.cache = new e.cacheImpl, e.currentRequestId = 0, e.rowHeight = e.list.height() / Math.ceil($("li.thumbnail", e.list).length / 10), e.cacheDefaultItems(), e.switchers.each(function() {
      $(this).click(e.switchCategory)
    }), e.preloadLoadingImage()
  }, e.cacheDefaultItems = function() {
    var t = e.switchers.filter(".active").first().text(),
      n = $("li.thumbnail", e.list);
    e.cache.set(t, n)
  }, e.preloadLoadingImage = function() {
    var t = new Image;
    t.src = $("img", e.loader).attr("src")
  }, e.switchCategory = function(t) {
    var n = $(this),
      r;
    t.preventDefault();
    if(!e.activateSelectedButton(n)) return;
    e.hideCategoryLinks(), e.currentRequestId += 1, r = e.cache.get(n.text()), r ? e.showItems(r, n) : (e.showLoader(), $.ajax({
      context: {
        requestId: e.currentRequestId
      },
      url: n.attr("data-url"),
      success: function(t) {
        if(e.currentRequestId === $(this).get(0).requestId) {
          var r = $("li.thumbnail", t);
          e.cache.set(n.text(), r), e.preloadThumbnails(r, n)
        }
      },
      cache: !1
    }))
  }, e.hideCategoryLinks = function() {
    e.categoryLinks.children().hide()
  }, e.showCategoryLinks = function(t) {
    var n, r;
    t.text().toLowerCase() === "all" ? (r = "View: ", n = "all", $("a.popular", e.categoryLinks).attr("href", "/category/" + n + "?sort_by=sales_count&amp;type=files&amp;page=1&amp;categories=" + n)) : (r = t.text() + ": ", n = t.attr("data-category-path"), $("a.popular", e.categoryLinks).attr("href", "/popular_item/by_category?category=" + n)), $(".prefix", e.categoryLinks).text(r), $("a.all", e.categoryLinks).attr("href", "/category/" + n), e.categoryLinks.children().fadeIn("slow")
  }, e.activateSelectedButton = function(t) {
    return $(t).hasClass("active") ? !1 : (e.switchers.removeClass("active"), $(t).addClass("active"), !0)
  }, e.preloadThumbnails = function(t, n) {
    var r = $([]),
      i = 0,
      s = 0,
      o;
    $("img.preload", t).each(function() {
      var e = new Image;
      r.push(e)
    }), o = function() {
      i += 1, r.length === i && e.showItems(t, n)
    }, r.bind("load", o), r.bind("error", o), $("img.preload", t).each(function() {
      r[s].src = $(this).attr("src"), s += 1
    })
  }, e.showItems = function(t, n) {
    var r, i = 0;
    e.showInterval && clearInterval(e.showInterval), e.hideLoader(function() {
      r = $("li.thumbnail", e.list).length, $("li.thumbnail", e.list).detach(), e.list.append(t), t.hide(), e.list.show(), e.resizeItemList(t.length, r), e.showInterval = setInterval(function() {
        i + 1 === t.length && clearInterval(e.showInterval), $(t.get(i)).fadeIn(200), i += 1
      }, 16), e.showCategoryLinks(n), $(document).trigger("homepage-new-items-changed")
    })
  }, e.resizeItemList = function(t, n) {
    var r = Math.ceil(t / 10),
      i = Math.ceil(n / 10),
      s;
    if(r > i) s = e.height() + (r - i) * e.rowHeight;
    else {
      if(!(r < i)) return;
      s = e.height()
    }
    $("#recent-files-wrapper").css({
      height: s + "px"
    }), e.list.animate({
      height: e.rowHeight * r + "px"
    }, 400, function() {
      $("#recent-files-wrapper").css({
        height: e.height() + "px"
      })
    })
  }, e.showLoader = function() {
    var t = $("img", e.loader),
      n = e.list.css("height"),
      r;
    e.list.hide(), e.loader.css({
      height: n
    }), r = parseInt(n, 10) / 2 - 44, t.css({
      marginTop: r + "px"
    }), e.loader.fadeIn("slow")
  }, e.hideLoader = function(t) {
    e.loader.fadeOut("fast", t)
  }, e.cacheImpl = function() {
    var e = this;
    return e.store = {}, e.get = function(t) {
      return e.store[t]
    }, e.set = function(t, n) {
      e.store[t] = n
    }, e
  }, e.initialize()
};
var CategoryTree = function() {
  var e = $(this);
  return {
    setupCategoryTree: function(e) {
      $("a", e).each(function() {
        if($("li", $("> ul", $(this).parent())).length) {
          var e = $(this).parent();
          e.addClass("expandable")
        }
      })
    },
    open_next: function(e, t) {
      var n = $(e),
        r = $(t),
        i = $("ul", r),
        s = $("> ul", n.parent()).children().clone();
      if(n.hasClass("all-category") || $("li", $("> ul", n.parent())).length === 0) return;
      n.parent().parent().find(".active").removeClass("active"), n.parent().addClass("active"), r.removeClass("empty"), i.empty(), $("ul", r).length || (i = $("<ul></ul>"), r.append(i)), i.append('<li><a href="' + e.get(0) + '" class="all-category">All ' + $(e.get(0)).html() + "</a></li>"), i.append(s), i.is(":empty") && (i.remove(), r.addClass("empty"))
    }
  }
}, Slider = function(e, t) {
  var n = this,
    r, i, s, o, u, a, f, l = parseInt(t.slide_duration, 10) || 3e3,
    c = parseInt(t.transition_time, 10) || 700;
  return r = $(e), s = $.map(t.slides, function(e, t) {
    var n = {
      loaded: !1,
      url: e.item.image_url,
      author: e.author,
      item: e.item,
      html: $('<li><a href="' + e.item.url + '"></a></li>').hide(),
      button: $('<li data-id="' + t + '"><a href="#">' + t + "</a></li>").click(function() {
        return clearTimeout(i), n.display(), !1
      }),
      display: function() {
        var e = this.html.parent(),
          t = this.html,
          n = c;
        e.find(".active").removeClass("active").fadeOut(n), t.addClass("active").fadeIn(n), this.button.parent().find(".active").removeClass("active"), this.button.addClass("active")
      },
      load: function() {
        var e = this,
          t;
        e.loaded || (t = $('<img height="300" width="960" />'), t.load(function() {
          e.loaded = !0, $("a", e.html).append(t), e.html.append('<span><a href="' + e.author.url + '">' + e.author.name + "</a> - " + '<a href="' + e.item.url + '">' + e.item.name + "</a></span>")
        }), t.attr({
          src: e.url
        }), r.append(e.html))
      }
    };
    return n
  }), o = function(e) {
    clearTimeout(i), s[e] !== undefined && s[e].loaded ? (s[e].display(), i = setTimeout(function() {
      o((e + 1) % s.length)
    }, l)) : i = setTimeout(function() {
      o(e)
    }, 100)
  }, a = function() {
    f = $('<ol id="slider-buttons"></ol>'), $(s).each(function(e, t) {
      t.load(), f.append(t.button)
    }), r.parent().append(f)
  }, {
    play: function() {
      a(), o(0)
    },
    stop: function() {
      clearTimeout(i)
    }
  }
};
(function(e) {
  var t, n;
  t = function(e, t) {
    t.find(".active").removeClass("active"), e.addClass("active")
  }, n = function(n, r) {
    var i = e(this),
      s = i.closest("ul"),
      o = i.attr("href"),
      u = {}, a, f;
    if(/^#\w+/.test(o)) {
      n.preventDefault();
      if(i.hasClass("active")) return;
      a = s.find(".active").last()[0], f = e(o), t(i, s), t(f, f.parent()), r !== !0 && (u.tab = o.substr(1), e.bbq.pushState(u)), i.trigger({
        type: "change",
        relatedTarget: a
      })
    }
  }, e.fn.ENVATO_tabs = function(t, r) {
    var i = e(t).find("a");
    return this.delegate(t + " a", "click.tabs", n), e(window).bind("hashchange", function(t) {
      var n = e.bbq.getState("tab");
      n === undefined ? i.first().trigger("click", !0) : e("a[href=#" + n + "]").trigger("click", !0)
    }), e(window).trigger("hashchange"), this
  }
})(window.jQuery),
function(e) {
  var t, n;
  t = function(t, r) {
    var i = e(t),
      s = i.find("button[type=submit]"),
      o = e(r);
    i.on("submit", function(t) {
      var r = i.attr("action");
      t.preventDefault(), s.attr("disabled", "disabled").addClass("btn-icon waiting"), e.ajax({
        type: "POST",
        url: r,
        data: i.serialize(),
        dataType: "json",
        success: function(e) {
          o.html(n(e.followers)), e.following ? (i.attr("action", r.replace("follow", "unfollow")), s.html("Unfollow").removeAttr("disabled").removeClass("btn-icon waiting")) : (i.attr("action", r.replace("unfollow", "follow")), s.html("Follow").removeAttr("disabled").removeClass("btn-icon waiting"))
        }
      })
    })
  }, n = function(e) {
    var t, n;
    return n = e.toString().replace(/(\d)(?=(\d{3})+$)/g, "$1,"), e === 1 ? t = "Follower" : t = "Followers", n + " " + t
  }, marketplace.followUser = {}, marketplace.followUser.init = t
}(jQuery), marketplace.posts = marketplace.posts || {}, marketplace.posts.badgeExposer = function() {
  $("#content").on("click.badge-exposer", ".badge-exposer a", function(e) {
    e.preventDefault(), $(e.target).parent().siblings(".badges").find(".hidden").removeClass("hidden").end().end().remove()
  })
}, $(document).ready(function() {
  $("form#new-item-submission").newItemSubmissionForm()
}), $.fn.newItemSubmissionForm = function() {
  return $(this).each(function() {
    var e = $("input.item-type", this),
      t = $("li", this);
    t.click(function() {
      t.removeClass("selected"), $(this).addClass("selected"), e.val($(this).attr("data-item-type-key"))
    })
  }), this
},
function() {
  marketplace.tracker = {
    analytics: {
      logPageView: function() {
        return this.logGoogleAnalyticsPageView(), this.logWebtrendsPageView()
      },
      logGoogleAnalyticsPageView: function() {
        if(typeof _gaq != "undefined" && _gaq !== null) return _gaq.push(["_trackPageview", this.relativePath()])
      },
      logWebtrendsPageView: function() {
        if(typeof Webtrends != "undefined" && Webtrends !== null) return Webtrends.multiTrack({
          args: {
            "DCS.dcsuri": this.relativePath()
          }
        })
      },
      logPageEvent: function(e, t, n) {
        if(typeof _gaq != "undefined" && _gaq !== null) return _gaq.push(["_trackEvent", e, t, n])
      },
      relativePath: function() {
        return document.location.pathname + document.location.search
      }
    },
    errors: {
      init: function() {
        return this.trackScriptErrors(), this.trackBrokenImages()
      },
      trackScriptErrors: function() {
        var e = this;
        return window.onerror = function(t, n, r) {
          return e.log(t, n, r)
        }
      },
      trackBrokenImages: function() {
        var e;
        return e = $("img"), e.on("error.imageError", function(e) {
          return e.stopPropagation(), marketplace.tracker.analytics.logPageEvent("Error", "imageError", "image: " + this.src + " page: " + document.location.pathname)
        }), $(window).on("load.imageError", function() {
          return e.off(".imageError")
        })
      },
      log: function(e, t, n) {
        var r;
        if(t.match(/envato.min.js$/)) return r = {
          uri: document.location.href,
          context: navigator.userAgent,
          error: e,
          file: t,
          line: n
        }, $.ajax({
          type: "POST",
          url: "/error_trackers/javascript",
          data: JSON.stringify(r),
          contentType: "application/json; charset=utf-8"
        })
      }
    }
  }
}.call(this),
function() {
  Marketplace.prototype.PjaxPagination = function() {
    function e(e, t) {
      this.containerSelector = e, this.initialiserForView = t, this.$paginations = $(".pagination")
    }
    return e.prototype.setup = function() {
      this.setupPjax(), this.handleKeyMapping();
      if(this.initialiserForView != null) return this.initialiserForView()
    }, e.prototype.setupPjax = function() {
      var e = this;
      return $("body").on({
        "pjax:start": function() {
          return e.start()
        },
        "pjax:success": function() {
          return e.success()
        },
        "pjax:end": function() {
          e.$paginations = $(".pagination");
          if(e.initialiserForView != null) return e.initialiserForView()
        }
      }).pjax(".pagination a", this.containerSelector, {
        timeout: 5e3,
        scrollTo: !1
      })
    }, e.prototype.success = function() {
      return this.topPaginationIsVisible() || window.scroll(document.body.offsetLeft, 0), marketplace.tracker.analytics.logWebtrendsPageView()
    }, e.prototype.start = function() {
      return this.$paginations.addClass("loading")
    }, e.prototype.handleKeyMapping = function() {
      var e, t, n = this;
      return t = {
        leftArrow: 37,
        rightArrow: 39
      }, e = !1, $("body").on({
        "focusin.pagination": function() {
          return e = !0
        },
        "focusout.pagination": function() {
          return e = !1
        },
        "keyup.pagination": function(r) {
          var i;
          if(e === !1) {
            i = r.keyCode || r.which;
            if(i === t.leftArrow) return n.clickLink(".previous_page");
            if(i === t.rightArrow) return n.clickLink(".next_page")
          }
        }
      })
    }, e.prototype.clickLink = function(e) {
      return this.$paginations.first().find(e).first().click()
    }, e.prototype.topPaginationIsVisible = function() {
      var e;
      return e = $(".pagination").first(), e.length && e.offset().top + e.height() > $(window).scrollTop()
    }, e
  }()
}.call(this),
function() {
  Handlebars.registerHelper("replaceIfEmpty", function(e, t) {
    return e != null ? e : t
  })
}.call(this),
function() {
  marketplace.rating = {
    init: function() {
      return this.starOnUrl = "/static/img/star-on.png", this.starOffUrl = "/static/img/star-off.png", this.initEvents()
    },
    initEvents: function() {
      var e = this;
      return $(".stars", ".rating-container").live("mouseleave", function(t) {
        var n;
        return n = $(t.currentTarget), e.reset_stars(n.attr("data-star-set-id"), n.attr("data-rating"))
      }).live("ajax:success", function(e, t, n) {
        return $("#rate_collection").html(t)
      }).find("a").live("click", function() {
        var e;
        return e = $(this), e.parent().attr("data-rating", e.index() + 1)
      })
    },
    toggle_stars: function(e, t) {
      var n, r, i, s;
      s = [];
      for(r = i = 1; i <= 5; r = ++i) n = "" + e + "_" + r, r > t ? s.push(this.turn_off_star(n)) : s.push(this.turn_on_star(n));
      return s
    },
    turn_on_star: function(e) {
      return $("#" + e).attr("src", this.starOnUrl)
    },
    turn_off_star: function(e) {
      return $("#" + e).attr("src", this.starOffUrl)
    },
    reset_stars: function(e, t) {
      return this.toggle_stars(e, t)
    }
  }
}.call(this),
function() {
  Marketplace.prototype.runQueues = function() {
    var e = this;
    return this.load = function(e) {
      return yepnope.apply(window, [e])
    }, this.scriptQueue.length ? yepnope({
      load: this.scriptQueue,
      complete: function() {
        return e.runCallbacks(e.callbackQueue)
      }
    }) : this.runCallbacks(this.callbackQueue)
  }, Marketplace.prototype.runCallbacks = function(e) {
    return e.length && _.each(e, function(e) {
      return e.apply(window)
    }), this.queue = function(e) {
      return e.apply(window)
    }
  }
}.call(this),
function() {
  marketplace.listControls = {
    initialised: !1,
    init: function(e) {
      return e == null && (e = !1), this.initialised ? this.reset(e) : ($(document).on("change.sorter", ".sort_select", function() {
        return this.form.submit()
      }), this.sortDirection(), e && this.layoutSwitcher(), this.initialised = !0)
    },
    reset: function(e) {
      this.sortDirection();
      if(e) return this.setLayout($.cookie("item-layout"))
    },
    sortDirection: function() {
      var e, t, n;
      t = $("#sort-direction-form");
      if(t.length) return n = t.data().order, e = $("#sort-direction"), t.hasClass("hidden") && $(".sort-direction-" + n).remove(), e.displayButtonAsLink({
        "class": "sort-control sort-control-tooltip sort-direction-" + n,
        "data-tooltip": e.text()
      })
    },
    layoutSwitcher: function() {
      return $(document).on("click.sorter", ".layout-list, .layout-grid", function(e) {
        var t;
        return t = $(e.target), t.hasClass("active") ? !1 : t.hasClass("layout-list") ? ($(".item-grid").removeClass("item-grid").addClass("item-list"), $(".layout-switcher").find(".active").removeClass("active"), t.addClass("active"), $.cookie("item-layout", "list")) : ($(".item-list").removeClass("item-list").addClass("item-grid"), $(".layout-switcher").find(".active").removeClass("active"), t.addClass("active"), $.cookie("item-layout", "grid")), e.preventDefault()
      }), this.setLayout($.cookie("item-layout"))
    },
    setLayout: function(e) {
      return e ? $(".layout-" + e).click() : $(".item-list").length ? $(".layout-list").addClass("active") : $(".layout-grid").addClass("active")
    }
  }
}.call(this),
function() {
  var e = function(e, t) {
    return function() {
      return e.apply(t, arguments)
    }
  };
  Marketplace.prototype.Banner = function() {
    function t(t, n) {
      this.promoName = t, this.closeBanner = e(this.closeBanner, this), this.$banner = $(n), this.showBanner()
    }
    return t.prototype.showBanner = function() {
      if($.cookie(this.promoName) !== "hidden") return this.$banner.removeClass("hidden").find(".header-strip-close").on("click.closeBanner", this.closeBanner)
    }, t.prototype.closeBanner = function(e) {
      return this.$banner.slideUp(400), $.cookie(this.promoName, "hidden", {
        path: "/",
        expires: 10
      }), e.preventDefault()
    }, t
  }()
}.call(this),
function() {
  var e = function(e, t) {
    return function() {
      return e.apply(t, arguments)
    }
  };
  Marketplace.prototype.Meter = function() {
    function t(t, n, r) {
      this.$field = t, this.$meter = n, this.username = r, this.getStrength = e(this.getStrength, this), this.jqxhr = null, this.$meterLabel = this.$meter.find(".meter-label"), this.bindKeyEvents(), this.prefilterAjaxRequestForMeter()
    }
    return t.prototype.bindKeyEvents = function() {
      var e = this;
      return this.$field.on({
        "keyup.strength": function(t) {
          if(!(t.keyCode === 9 || e.$field.data("previousValue") && e.$field.val())) return e.getStrength()
        },
        "focus.strength": function() {
          if(e.$field.data("previousValue")) return e.$field.valid()
        }
      })
    }, t.prototype.getStrength = function() {
      var e = this;
      return this.jqxhr !== null && this.jqxhr.abort(), this.jqxhr = $.ajax({
        url: "/signup_ajax/password_strength_errors",
        type: "post",
        dataType: "json",
        data: {
          username: this.username,
          password: function() {
            return e.$field.val()
          }
        },
        beforeSend: function() {
          return e.$field.addClass("validating")
        },
        complete: function() {
          return e.$field.removeClass("validating")
        },
        success: function(t) {
          return e.updateMeter(t.strength, t.label), e.jqxhr = null
        }
      })
    }, t.prototype.updateMeter = function(e, t) {
      var n;
      n = "meter-" + e;
      if(!this.$meter.hasClass(n)) return this.$meter.removeClass("meter-init meter-weak meter-acceptable meter-good meter-great").addClass(n), this.$meterLabel.empty().append(t)
    }, t.prototype.prefilterAjaxRequestForMeter = function() {
      var e = this;
      return $.ajaxPrefilter(function(t) {
        var n;
        if(t.passwordStrengthResponseFilter) return n = t.success, t.success = function(t) {
          return e.updateMeter(t.strength, t.label), n(t.acceptable)
        }
      })
    }, t
  }()
}.call(this),
function() {
  var e;
  e = function(e) {
    return this.form = e, this.$form = $(e), this.init(), this
  }, e.prototype.init = function() {
    return this.$form.on("submit.disableOnSubmit", function(e) {
      return $(e.target).find("button[type=submit], input[type=submit]").prop("disabled", !0)
    })
  }, $.fn.disableOnSubmit = function(t) {
    return this.each(function() {
      var t, n;
      t = $(this);
      if(t.data("plugin_disableOnSubmit") === void 0) return n = new e(this), t.data("plugin_disableOnSubmit", n)
    })
  }
}.call(this),
function() {
  Marketplace.prototype.watch_category_select = function() {
    return $("#category").change(function() {
      return $.ajax({
        url: "/upload/category_select_changed",
        data: $.param({
          category: $(this).val(),
          id: $(this).data("id")
        }),
        dataType: "html",
        type: "post",
        success: function(e) {
          return $("#attribute_fields").replaceWith(e), $("form.fancy-form").jqTransformReApply(), $("form.item-form").itemForm()
        }
      })
    })
  }
}.call(this),
function() {
  var e, t = function(e, t) {
    return function() {
      return e.apply(t, arguments)
    }
  };
  e = function() {
    function e(e, n) {
      this.redirectTo = t(this.redirectTo, this), this.submitButtonState = t(this.submitButtonState, this), this.handleResponse = t(this.handleResponse, this), this.options = $.extend({}, this.defaults, n), this.form = e, this.$form = $(e), this.$submit = $(this.options.submitButton), this.init(), this
    }
    return e.prototype.defaults = {
      captchaField: "#recaptcha_response_field",
      submitButton: "button[type=submit]"
    }, e.prototype.init = function() {
      var e = this;
      return this.$form.on("checkCaptchaValue", function(t) {
        var n, r;
        return e.submitButtonState("waiting"), r = e.$form.serializeArray(), n = {}, _.each(r, function(e) {
          return n[e.name] = e.value
        }), $.ajax({
          url: e.$form.attr("action"),
          data: n,
          type: "POST",
          dataType: "json",
          error: function() {
            return this.$form[0].submit()
          },
          success: e.handleResponse
        })
      })
    }, e.prototype.handleResponse = function(e) {
      if(e.state === "ok") return this.redirectTo(e.redirect);
      if(e.state === "error") return e.error_message.length === 1 && e.error_message[0].match(/captcha/) ? (Recaptcha.reload(), this.$form.data("validator") != null && this.$form.data("validator").showErrors({
        recaptcha_response_field: "Argh, that was wrong! Try again."
      }), this.submitButtonState("submit")) : this.$form[0].submit()
    }, e.prototype.submitButtonState = function(e) {
      return e === "waiting" ? this.$submit.prop("disabled", !0).removeClass("submit").addClass("waiting") : this.$submit.prop("disabled", !1).removeClass("waiting").addClass(e)
    }, e.prototype.redirectTo = function(e) {
      return window.location.href = e
    }, e
  }(), $.fn.captchaInForm = function(t) {
    return this.each(function() {
      var n, r;
      n = $(this);
      if(n.data("plugin_captchaInForm") === void 0) return r = new e(this, t), n.data("plugin_captchaInForm", r)
    })
  }
}.call(this),
function() {
  var e = function(e, t) {
    return function() {
      return e.apply(t, arguments)
    }
  };
  Marketplace.prototype.Announcement = function() {
    function t(t, n) {
      this.closeAnnouncement = e(this.closeAnnouncement, this), this.$announcement = $(t), this.$announcement.find(n).on("click", this.closeAnnouncement)
    }
    return t.prototype.closeAnnouncement = function(e) {
      return this.$announcement.animate({
        height: "toggle",
        opacity: "toggle"
      }, "slow"), $.ajax({
        url: e.target.href,
        type: "get"
      }), e.preventDefault()
    }, t
  }()
}.call(this),
function() {
  Marketplace.prototype.faqList = function(e) {
    var t, n = this;
    t = $(e), t.find("p, ul ul").addClass("visuallyhidden"), t.on("click", ".faq-question", function(e) {
      var t;
      return t = $(e.target), t.closest("li").toggleClass("is-faq-open"), t.parent().nextUntil("h2").toggleClass("visuallyhidden"), e.preventDefault()
    });
    if(window.location.hash && $(window.location.hash).length) return $(window.location.hash).click()
  }
}.call(this),
function() {
  Marketplace.prototype.insertPartial = function(e, t) {
    var n, r, i, s, o;
    return r = {
      container: ".insert-partial-container",
      complete: null,
      loadingClass: "is-loading"
    }, s = $.extend({}, r, t), n = $(s.container), i = function() {
      return n.empty().addClass(s.loadingClass), $.ajax({
        dataType: "html",
        url: e,
        success: o
      })
    }, o = function(e) {
      n.removeClass(s.loadingClass), typeof e == "string" && n.html(e);
      if(typeof s.complete == "function") return s.complete()
    }, i()
  }
}.call(this),
function() {
  var e;
  e = function(e, t) {
    return this.options = $.extend({}, this.defaults, t), this.element = e, this.$element = $(e), this.init(), this
  }, e.prototype.defaults = {
    toggle: ".toggle",
    classToToggle: "toggled"
  }, e.prototype.init = function() {
    var e = this;
    return this.$element.on("click.toggler", this.options.toggle, function(t) {
      return e.$element.toggleClass(e.options.classToToggle), t.preventDefault()
    })
  }, $.fn.toggler = function(t) {
    return this.each(function() {
      var n, r;
      n = $(this);
      if(n.data("plugin_toggler") === void 0) return r = new e(this, t), n.data("plugin_toggler", r)
    })
  }
}.call(this),
function() {
  var e;
  e = function(e, t) {
    return this.options = $.extend({}, this.defaults, t), this.element = e, this.$element = $(e), this.init(), this
  }, e.prototype.defaults = {
    exposer: ".exposer",
    exposeeClass: "hidden",
    destroyParent: !1
  }, e.prototype.init = function() {
    var e = this;
    return this.$element.on("click.exposer", this.options.exposer, function(t) {
      return $(t.delegateTarget).find("." + e.options.exposeeClass).removeClass(e.options.exposeeClass), e.options.destroyParent ? $(t.target).parent().remove() : $(t.target).remove(), t.preventDefault()
    })
  }, $.fn.exposer = function(t) {
    return this.each(function() {
      var n, r;
      n = $(this);
      if(n.data("plugin_exposer") === void 0) return r = new e(this, t), n.data("plugin_exposer", r)
    })
  }
}.call(this),
function() {
  var e;
  e = function(e, t) {
    return this.options = $.extend({}, this.defaults, t), this.element = e, this.$element = $(e), this.$allCheckbox = this.$element.find(this.options.allCheckbox), this.$normalCheckboxes = this.$element.find("input[type=checkbox]").not(this.options.allCheckbox), this.init(), this
  }, e.prototype.defaults = {
    allCheckbox: ".all-checkbox"
  }, e.prototype.init = function() {
    var e = this;
    return this.$element.on("change.checkboxList", "input[type=checkbox]", function(t) {
      var n, r;
      r = t.target, n = $(r);
      if(e.$allCheckbox.is(r)) return r.checked = !0, e.$normalCheckboxes.prop("checked", !1);
      if(r.checked) return e.$allCheckbox.prop("checked", !1);
      if(e.$normalCheckboxes.filter(":checked").length === 0) return e.$allCheckbox.prop("checked", !0)
    })
  }, $.fn.checkboxList = function(t) {
    return this.each(function() {
      var n, r;
      n = $(this);
      if(n.data("plugin_checkboxList") === void 0) return r = new e(this, t), n.data("plugin_checkboxList", r)
    })
  }
}.call(this),
function() {
  Marketplace.prototype.ajaxify_forum_editing = function() {
    return $(document).on("ajax:success", "a[data-action=edit]", function(e, t, n) {
      var r, i, s;
      return i = $(t).data("message-id"), r = $(t), s = $("#message_content_" + i), s.after(r), s.hide(), r.find("a").click(function(e) {
        return e.preventDefault(), s.show(), r.remove()
      }), r.on("ajax:aborted:required", function() {
        return alert("Message content cannot be empty.")
      }), r.on("ajax:success", function(e, t, n) {
        return s.html(t), s.show(), r.remove()
      })
    })
  }
}.call(this),
function() {
  marketplace.forumTools = function() {
    return $(".post-tools").on("click", ".post-flag", function(e) {
      return marketplace.insertPartial(e.target.href, {
        container: $(e.target).closest(".post-tools").find(".insert-partial-container")
      }), e.preventDefault()
    }), $(".post-tools").on("click", ".complaint-form__cancel", function(e) {
      return $(e.target).closest(".insert-partial-container").empty()
    })
  }
}.call(this),
function() {
  Marketplace.prototype.CommentList = function() {
    function e(e) {
      var t;
      this.list = e != null ? e : ".comment-list", t = $(this.list), t.on("focusin", ".comment__new-reply-field", this.activateField), t.on("focusout", ".comment__new-reply-field", this.deactivateField), t.on("ajax:beforeSend", ".comment__new-reply form", this.newReply.beforeSend), t.on("ajax:success", ".comment__new-reply form", this.newReply.success), t.on("ajax:error", ".comment__new-reply form", this.newReply.error), t.on("click", ".comment__meta__edit, .post-flag", this.inlineEdit), t.on("click", ".comment__cancel, .complaint-form__cancel", this.cancelInlineEdit), $(".comment__new-reply-field").autosize()
    }
    return e.prototype.activateField = function(e) {
      return $(e.target).closest(".comment__new-reply").addClass("comment__new-reply--is-active")
    }, e.prototype.deactivateField = function(e) {
      var t;
      t = $(e.target);
      if(t.val() === "") return t.closest(".comment__new-reply").removeClass("comment__new-reply--is-active")
    }, e.prototype.newReply = {
      beforeSend: function(e, t, n) {
        return $(e.target).closest(".comment__reply").addClass("comment__reply--is-loading")
      },
      success: function(e, t, n, r) {
        var i, s;
        if(t.status === "ok") return i = $(e.target).closest(".comment__reply"), i.removeClass("comment__reply--is-loading"), i.find("textarea").val("").blur().trigger("autosize"), s = $(t.partial), s.insertBefore(i), marketplace.tracker.analytics.logPageEvent("ItemComments", "Add");
        if(t.status === "error") return window.location.href = t.redirect_to
      },
      error: function(e, t, n, r) {
        return e.target.submit()
      }
    }, e.prototype.inlineEdit = function(e) {
      var t, n;
      return n = $(e.target), t = n.closest(".comment__body, .comment__reply__body"), marketplace.insertPartial(e.target.href, {
        container: t.find(".comment__inline-edit"),
        loadingClass: "comment__inline-edit--is-loading"
      }), n.hasClass("comment__meta__edit") ? (t.find(".comment__content, .comment__reply__content").addClass("hidden"), marketplace.tracker.analytics.logPageEvent("ItemComments", "Edit")) : (t.find(".comment__content, .comment__reply__content").removeClass("hidden"), marketplace.tracker.analytics.logPageEvent("ItemComments", "Flag")), e.preventDefault()
    }, e.prototype.cancelInlineEdit = function(e) {
      var t;
      return t = $(e.target), t.closest(".comment__body, .comment__reply__body").find(".comment__content, .comment__reply__content").removeClass("hidden"), t.closest(".comment__inline-edit").empty()
    }, e
  }()
}.call(this),
function() {
  Marketplace.prototype.ajaxify_weekly_features = function() {
    var e;
    return e = function(e) {
      return $(document).on("click", "" + e + " a[data-url]", function(t) {
        return t.preventDefault(), $.ajax({
          url: $(this).data("url"),
          success: function(t) {
            return $(e).html(t)
          }
        })
      })
    }, e("#weekly-features"), e("#home-following")
  }
}.call(this),
function() {
  Marketplace.prototype.ItemFaqs = function() {
    function e() {
      var e = this;
      this.$faqs = $("#faq-index"), this.currentRequest = !1, this.$faqs.on("ajax:success", ".movement-controls a", function(t, n, r) {
        return e.$faqs.html(n), e.$faqs.removeClass("is-processing"), e.currentRequest = !1
      }), this.$faqs.on("ajax:beforeSend", ".movement-controls a", function(t, n) {
        return e.currentRequest ? n.abort() : (e.currentRequest = !0, e.$faqs.addClass("is-processing"))
      })
    }
    return e
  }()
}.call(this),
function() {
  Marketplace.prototype.UserItemSupportPreferences = function() {
    function e(e) {
      var t = this;
      this.scope = e, $("select", this.scope).change(function() {
        return t.onSelectChanged()
      }), $("#item_support_preferences_supported", this.scope).change(function() {
        return t.onSupportedCheckboxChanged()
      }), this.onSelectChanged(), this.onSupportedCheckboxChanged()
    }
    return e.prototype.onSelectChanged = function() {
      var e;
      $(".sometimes-hidden", this.scope).addClass("hidden"), e = $("select", this.scope).val();
      if(e === "email") return $("#email-section", this.scope).removeClass("hidden");
      if(e === "url") return $("#url-section", this.scope).removeClass("hidden")
    }, e.prototype.onSupportedCheckboxChanged = function() {
      return $("#item_support_preferences_supported", this.scope).prop("checked") ? $(".support-inputs", this.scope).removeClass("hidden") : $(".support-inputs", this.scope).addClass("hidden")
    }, e
  }()
}.call(this),
function() {
  marketplace.validate.paymentRequest = function() {
    var e, t;
    return e = function(e) {
      return $(e).is(":visible")
    }, t = function(e, t, n) {
      return {
        url: "/withdrawals_ajax/validate_swift",
        type: "post",
        data: {
          attribute: n || e,
          value: function() {
            return t.val()
          }
        },
        beforeSend: function() {
          return t.addClass("validating")
        },
        complete: function() {
          return t.removeClass("validating")
        }
      }
    }, $("#payment_form").validate({
      errorClass: "invalid",
      validClass: "valid",
      rules: {
        payment_email_address: {
          required: e
        },
        payment_email_address_confirmation: {
          required: e
        },
        swift_full_address: {
          required: e,
          remote: {
            depends: e,
            param: t("swift_full_address", $("#swift_full_address"))
          }
        },
        swift_full_address_line2: {
          remote: {
            depends: e,
            param: t("swift_full_address_line2", $("#swift_full_address_line2"))
          }
        },
        swift_full_address_line3: {
          remote: {
            depends: e,
            param: t("swift_full_address_line3", $("#swift_full_address_line3"))
          }
        },
        swift_address_state: {
          remote: {
            depends: e,
            param: t("swift_address_state", $("#swift_address_state"))
          }
        },
        swift_address_postcode: {
          remote: {
            depends: e,
            param: t("swift_address_postcode", $("#swift_address_postcode"))
          }
        },
        swift_address_country_code: {
          required: e
        },
        swift_bank_account_name: {
          required: e,
          remote: {
            depends: e,
            param: t("swift_bank_account_name", $("#swift_bank_account_name"))
          }
        },
        swift_bank_account_number: {
          required: e,
          remote: {
            depends: e,
            param: t("swift_bank_account_number", $("#swift_bank_account_number"))
          }
        },
        swift_code: {
          required: e,
          remote: {
            depends: e,
            param: t("swift_code", $("#swift_code"), "swift_swift_code")
          }
        },
        swift_bank_name: {
          required: e,
          remote: {
            depends: e,
            param: t("swift_bank_name", $("#swift_bank_name"))
          }
        },
        swift_bank_branch_country_code: {
          required: e
        },
        swift_bank_branch_city: {
          remote: {
            depends: e,
            param: t("swift_bank_branch_city", $("#swift_bank_branch_city"))
          }
        },
        swift_intermediary_bank_code: {
          remote: {
            depends: e,
            param: t("swift_intermediary_bank_code", $("#swift_intermediary_bank_code"))
          }
        },
        swift_intermediary_bank_name: {
          remote: {
            depends: e,
            param: t("swift_intermediary_bank_name", $("#swift_intermediary_bank_name"))
          }
        },
        swift_intermediary_bank_city: {
          remote: {
            depends: e,
            param: t("swift_intermediary_bank_city", $("#swift_intermediary_bank_city"))
          }
        },
        swift_intermediary_bank_country_code: {
          remote: {
            depends: e,
            param: t("swift_intermediary_bank_country_code", $("#swift_intermediary_bank_country_code"))
          }
        },
        instructions_from_author: {
          remote: {
            depends: e,
            param: t("instructions_from_author", $("#instructions_from_author"), "swift_additional_instructions")
          }
        }
      }
    })
  }
}.call(this),
function() {
  marketplace.validate.itemAttributeFields = function() {
    return $.validator.addMethod("regex", function(e, t, n) {
      var r, i, s;
      return r = $(t), s = r.attr("data-regex"), i = new RegExp(s.replace(/^\/|\/$|\/i$|\/g$|\/m$|\/y$/g, "")), $.validator.messages.regex = r.attr("data-message"), e === "" ? !0 : i.test(e)
    }), $.validator.addClassRules("regex-validate", {
      regex: !0
    }), $("#attribute_fields").closest("form").validate({
      errorClass: "invalid",
      validClass: "valid",
      errorPlacement: function(e, t) {
        return t.attr("name") === "user[agrees_to_terms]" ? e.appendTo($(t).parent("label")) : e.insertAfter(t)
      }
    })
  }
}.call(this),
function() {
  marketplace.validate.signup = function() {
    var e, t, n;
    return $.validator.addMethod("regex", function(e, t, n) {
      var r;
      return r = new RegExp(n), this.optional(t) || r.test(e)
    }, "Please check your input."), t = $("#user_username"), e = $("#user_password"), n = new marketplace.Meter(e, $(".meter"), marketplace.username), $("#signup_form").validate({
      errorClass: "invalid",
      errorPlacement: function(e, t) {
        return t.attr("type") === "checkbox" ? e.appendTo(t.closest(".inputs")) : t.after(e)
      },
      rules: {
        "user[username]": {
          remote: {
            url: "/signup_ajax/username_availability",
            type: "post",
            data: {
              username: function() {
                return t.val()
              }
            },
            beforeSend: function() {
              return t.addClass("validating")
            },
            complete: function() {
              return t.removeClass("validating")
            }
          }
        },
        "user[password]": {
          remote: {
            url: "/signup_ajax/password_strength_errors",
            type: "post",
            passwordStrengthResponseFilter: !0,
            data: {
              username: function() {
                return t.val()
              },
              password: function() {
                return e.val()
              }
            },
            beforeSend: function() {
              return e.addClass("validating")
            },
            complete: function() {
              return e.removeClass("validating")
            }
          }
        },
        "user[email]": {
          email: !0
        },
        "user[email_confirmation]": {
          email: !0,
          equalTo: "#user_email"
        }
      },
      messages: {
        "user[username]": {
          required: "Please enter a username",
          remote: "Please choose another username"
        },
        "user[password]": {
          required: "Please enter a password",
          password: "Please choose a stronger password",
          remote: "Please choose a stronger password"
        },
        "user[email]": {
          email: "Please enter a valid email",
          required: "Please enter your email"
        },
        "user[email_confirmation]": {
          email: "Please enter a valid email",
          equalTo: "Emails do not match",
          required: "Please re-enter your email"
        },
        "user[name]": {
          required: "Please enter your full name"
        },
        user_agreed_with_terms_and_conditions: {
          required: "Please agree with with the terms & conditions"
        },
        recaptcha_response_field: {
          required: "This is requred"
        }
      },
      submitHandler: function(e) {
        return $(e).trigger("checkCaptchaValue")
      }
    }), t.on("blur.force-password-revalidation", function() {
      if(e.data("previousValue")) return e.removeData("previousValue").valid()
    })
  }
}.call(this),
function() {
  marketplace.validate.changePassword = function() {
    var e, t;
    return e = $("#user_password"), t = new marketplace.Meter(e, $(".meter"), marketplace.username), $("#change-password-form").validate({
      errorClass: "invalid",
      rules: {
        new_password: {
          remote: {
            url: "/signup_ajax/password_strength_errors",
            type: "post",
            passwordStrengthResponseFilter: !0,
            data: {
              username: marketplace.username,
              password: function() {
                return e.val()
              }
            },
            beforeSend: function() {
              return e.addClass("validating")
            },
            complete: function() {
              return e.removeClass("validating")
            }
          }
        },
        new_password_confirmed: {
          remote: !1,
          equalTo: "#user_password"
        }
      },
      messages: {
        password: {
          required: "Please enter your current password."
        },
        new_password: {
          remote: "Please choose a stronger password.",
          required: "Please enter a new password."
        },
        new_password_confirmed: {
          required: "Please confirm your new password.",
          equalTo: "Passwords do not match."
        }
      }
    })
  }
}.call(this),
function() {
  marketplace.validate.changeWeakPassword = function() {
    var e, t;
    return e = $("#password"), t = new marketplace.Meter(e, $(".meter"), marketplace.username), $("#change-password-form").validate({
      errorClass: "invalid",
      rules: {
        password: {
          remote: {
            url: "/signup_ajax/password_strength_errors",
            type: "post",
            passwordStrengthResponseFilter: !0,
            data: {
              username: marketplace.username,
              password: function() {
                return e.val()
              }
            },
            beforeSend: function() {
              return e.addClass("validating")
            },
            complete: function() {
              return e.removeClass("validating")
            }
          }
        },
        password_confirmation: {
          remote: !1,
          equalTo: "#password"
        }
      },
      messages: {
        current_password: {
          required: "Please enter your current password."
        },
        password: {
          remote: "Please choose a stronger password.",
          required: "Please enter a new password."
        },
        password_confirmation: {
          required: "Please confirm your new password.",
          equalTo: "Passwords do not match."
        }
      }
    })
  }
}.call(this),
function() {
  marketplace.validate.resetPassword = function() {
    var e, t;
    return e = $("#user_password"), t = new marketplace.Meter(e, $(".meter"), marketplace.username), $("#change-password-form").validate({
      errorClass: "invalid",
      rules: {
        password: {
          remote: {
            url: "/signup_ajax/password_strength_errors",
            type: "post",
            passwordStrengthResponseFilter: !0,
            data: {
              username: marketplace.username,
              password: function() {
                return e.val()
              }
            },
            beforeSend: function() {
              return e.addClass("validating")
            },
            complete: function() {
              return e.removeClass("validating")
            }
          }
        },
        password_again: {
          remote: !1,
          equalTo: "#user_password"
        }
      },
      messages: {
        password: {
          remote: "Please choose a stronger password.",
          required: "Please enter a new password."
        },
        password_again: {
          required: "Please confirm your new password.",
          equalTo: "Passwords do not match."
        }
      }
    })
  }
}.call(this),
function() {
  marketplace.initializers.badge_manager = function() {
    return Modernizr.load({
      test: Modernizr.touch,
      yep: "/javascripts/lib/jquery.ui.touch-punch.min.js",
      complete: function() {
        var e, t;
        return t = $("#badge-manager-list").addClass("dragging"), e = $("#choices"), t.sortable({
          update: function(n, r) {
            return e.val(t.sortable("toArray").join("::"))
          }
        }), e.val(t.sortable("toArray").join("::"))
      }
    })
  }
}.call(this),
function() {
  marketplace.initializers.itemDiscussion = function() {
    return $(".comment").exposer({
      destroyParent: !0,
      exposeeClass: "js-hidden"
    }), marketplace.posts.badgeExposer(), new marketplace.CommentList
  }
}.call(this),
function() {
  marketplace.initializers.forums = function() {
    return marketplace.forumTools(), marketplace.posts.badgeExposer()
  }
}.call(this),
function() {
  marketplace.initializers.signin = function() {
    var e, t, n, r, i, s, o, u, a, f, l, c, h, p, d, v;
    return n = $("#signin-form"), s = n.find(".submit"), o = $("#username"), r = $("#password"), e = $("#captcha"), i = $("#sign-in-errors"), t = $(".flash:not(#sign-in-errors)"), l = void 0, f = void 0, u = void 0, a = [], n.on("submit", function(e) {
      var t, n, i, s, u, c;
      t = {
        username: o.val(),
        password: r.val()
      }, s = Recaptcha.get_response(), i = Recaptcha.get_challenge(), s && (t.recaptcha_response_field = s, t.recaptcha_challenge_field = i);
      for(u = 0, c = a.length; u < c; u++) n = a[u], t[n] = $("#" + n).val();
      return e.preventDefault(), v("waiting"), $.ajax({
        url: "signin_ajax",
        data: t,
        type: "POST",
        dataType: "json",
        error: f,
        success: l
      })
    }), l = function(e) {
      switch(e.state) {
      case "ok":
        window.location = e.redirect;
        return;
      case "captcha":
        d();
        break;
      case "extra_fields":
        u(e.authField);
        break;
      case "password":
        h()
      }
      return e.error_message ? p(e.error_message) : c(), v("submit")
    }, u = function(e) {
      var t;
      if(!$("#" + e.fieldName).length) return a.push(e.fieldName), t = _.template('<div class="input-group auth-field"><label for="<%= fieldName %>"><%= fieldLabel %></label><div class="inputs"><input type="text" name="<%= fieldName %>" id="<%= fieldName %>" /></div></div>'), s.parent().before(t(e)), $("#" + e.fieldName).focus()
    }, h = function() {
      return e.addClass("hidden"), Recaptcha.reload(), $(".auth-field").remove()
    }, d = function() {
      return e.hasClass("hidden") ? (e.removeClass("hidden"), Recaptcha.focus_response_field()) : Recaptcha.reload()
    }, p = function(e) {
      return t.addClass("hidden"), i.text(e).removeClass("hidden"), o.val().length === 0 ? o.focus() : r.focus()
    }, c = function() {
      return i.addClass("hidden")
    }, f = function() {
      return n[0].submit()
    }, v = function(e) {
      switch(e) {
      case "waiting":
        return s.prop("disabled", !0).removeClass("submit").addClass("waiting");
      case "submit":
        return s.prop("disabled", !1).removeClass("waiting").addClass("submit")
      }
    }
  }
}.call(this),
function() {
  marketplace.initializers.signup = function() {
    return marketplace.validate.signup(), $("#signup_form").captchaInForm()
  }
}.call(this),
function() {
  marketplace.initializers.newSearchFacets = function() {
    return $(".facet-container").toggler({
      toggle: ".facet-collapsor",
      classToToggle: "facet-collapsed"
    }).exposer({
      exposer: ".facets-toggle",
      destroyParent: !0
    }), $(".facet-checkbox-list").checkboxList({
      allCheckbox: ".facet-all-checkbox"
    })
  }
}.call(this),
function() {
  marketplace.initializers.photoduneSearchResults = function(e) {
    return e == null && (e = {}), $("#tags-facet").exposer({
      exposer: ".facets-toggle",
      destroyParent: !0
    }), e.ajaxPagination ? (new marketplace.PjaxPagination("#paginated-content-container", function() {
      return marketplace.listControls.init()
    })).setup() : marketplace.listControls.init()
  }
}.call(this),
function() {
  marketplace.initializers.largePreview = function() {
    var e, t, n, r, i;
    if(marketplace.previewConfigs != null) {
      r = marketplace.previewConfigs, i = [];
      for(t = 0, n = r.
      length; t < n; t++) e = r[t], i.push(function(e) {
        var t;
        return t = new marketplace.ItemPreview(e), t.display()
      }(e));
      return i
    }
  }
}.call(this),
function() {
  marketplace.initializers.topAuthors = function() {
    return $("#squad, #site").on("change", function() {
      return this.form.submit()
    })
  }
}.call(this),
function() {
  marketplace.initializers.categoryTree = function() {
    var e;
    return e = new CategoryTree, e.setupCategoryTree("#first"), $("#first ul:first li").on("click", function() {
      return $("#second").empty(), e.open_next($("a", this).first(), "#second"), $("#third").empty().addClass("empty"), $("#fourth").empty().addClass("empty")
    }), $(".container").on("click", "#second li", function() {
      return e.open_next($("a", this).first(), "#third"), $("#fourth").empty().addClass("empty")
    }), $(".container").on("click", "#third li", function() {
      return e.open_next($("a", this).first(), "#fourth")
    }), $("li.expandable > a").on("click", function() {
      return $(this).parent().trigger("click"), !1
    }), $(".container").on("click", "li.expandable > a", function() {
      return $(this).parent().trigger("click"), !1
    })
  }
}.call(this),
function() {
  marketplace.initializers.itemList = function(e) {
    var t;
    return e == null && (e = {}), e.layoutSwitcher != null ? t = e.layoutSwitcher : t = !1, e.ajaxPagination ? (new marketplace.PjaxPagination("#paginated-content-container", function() {
      return marketplace.listControls.init(t)
    })).setup() : marketplace.listControls.init(t)
  }
}.call(this),
function() {
  marketplace.initializers.global = function() {
    return marketplace.tracker.errors.init(), marketplace.runQueues()
  }
}.call(this);





























/*global $: false, document: false, marketplace: false */

(function () {
    var newSwiftStarted = false, 

        // cache the dom elements in variables
        customAmountRadio = document.getElementById("maximum_at_period_end_false"),
        customAmount = document.getElementById("amount"),
        allEarnings = document.getElementById("maximum_at_period_end_true"),
        $allEarningsNotice = $("#all-earnings-notice"),
        
        servicePaypal = document.getElementById("service_paypal"),
        serviceSkrill = document.getElementById("service_moneybookers"),
        servicePayoneer = document.getElementById("service_payoneer"),
        serviceSwift = document.getElementById("service_swift"),

        $paypalAndSkrillFields = $(".paypal-skrill"),

        $payoneerNotice = $("#payoneer-notice"),

        $existingSwift = $("#existing-swift"),
        $showNewSwift = $("#show_swift_instructions"),
        $useExisting = $("#existing_swift_details"),
        $newSwift = $(".new-swift"),

        aussie = document.getElementById("taxable_australian_resident"),
        $taxationDetails = $("#taxation-details"),
        hobbyistTrue = document.getElementById("hobbyist_true"),
        hobbyistFalse = document.getElementById("hobbyist_false"),

        $taxNumbers = $(".tax-number"),

        $swiftNotice = $(".swift-notice"),
        $swiftAdditionalInstructions = $("#swift_additional_instructions"),
        $amountLessFee = $("#amount-less-fee"),
        maxWithdrawalAmountLessFee = $('#max-withdrawal-amount-less-fee').val(),

        // functions
        calculateWithdrawalAmountLessFee,
        check,
        checkAmount,
        checkService,
        hideServicesExcept,
        showPaypalSkrillFields,
        whichSwift,
        checkTax;
    
    calculateWithdrawalAmountLessFee = function () {
        if (typeof allEarnings !== "undefined" && allEarnings !== null && allEarnings.checked) {
            return;
        }

        var amount = $(customAmount).val().replace('$', ''), dollars = 0, cents = 0, amountLessFee = 0, parts;

        if (amount.match(/^\d+$/)) {
            dollars = parseInt(amount, 10);
        } else if (amount.match(/^\d+\.\d\d$/)) {
            parts = amount.split('.');
            dollars = parseInt(parts[0], 10);
            cents = parseInt(parts[1], 10);
        } else if (amount.match(/^\d{1,3},\d\d\d\.\d\d$/)) {
            parts = amount.split(',');
            dollars = parseInt(parts[0], 10) * 1000;
            parts = parts[1].split('.');
            dollars += parseInt(parts[0], 10);
            cents = parseInt(parts[1], 10);
        } else if (amount.match(/^\d{1,3},\d\d\d$/)) {
            parts = amount.split(',');
            dollars = parseInt(parts[0], 10) * 1000;
            dollars += parseInt(parts[1], 10);
        }

        amountLessFee = (dollars - parseFloat($('#swift-transaction-fee').val())).toString();

        if (cents < 10) {
            amountLessFee += '.0' + cents;
        } else {
            amountLessFee += '.' + cents;
        }

        $amountLessFee.html(amountLessFee);      
    };

    check = function () {
        checkAmount();
        checkService();
        checkTax();
    };

    checkAmount = function () {
        if (customAmountRadio.checked) {
            customAmount.disabled = false;
            $allEarningsNotice.addClass("hidden");
            calculateWithdrawalAmountLessFee();
        } else if (allEarnings.checked) {
            customAmount.disabled = true;
            $allEarningsNotice.removeClass("hidden");
            $amountLessFee.html(maxWithdrawalAmountLessFee);
        }
    };

    checkService = function () {
        if (servicePaypal.checked) {
            showPaypalSkrillFields("paypal");
            hideServicesExcept("paypal");
        } else if (serviceSkrill.checked) {
            showPaypalSkrillFields("skrill");
            hideServicesExcept("skrill");
        } else if (servicePayoneer.checked) {
            $payoneerNotice.removeClass("hidden");
            hideServicesExcept("payoneer");
        } else if (serviceSwift.checked) {
            if ($existingSwift.length > 0) {
                whichSwift();
            } else {
                $newSwift.removeClass("hidden");
            }
            hideServicesExcept("swift");
            $swiftNotice.removeClass("hidden");
            $swiftAdditionalInstructions.removeClass("hidden");
        }
    };

    hideServicesExcept = function (serviceToShow) {
        if (serviceToShow !== "paypal" && serviceToShow !== "skrill") {
            $paypalAndSkrillFields.addClass("hidden");
        }
        if (serviceToShow !== "payoneer") {
            $payoneerNotice.addClass("hidden");
        }
        if (serviceToShow !== "swift") {
            $existingSwift.addClass("hidden");
            $newSwift.addClass("hidden");
            $swiftNotice.addClass("hidden");
            $swiftAdditionalInstructions.addClass("hidden");
        }
    };

    showPaypalSkrillFields = function (service) {
        if (service === "paypal") {
            $paypalAndSkrillFields
                .removeClass("hidden")
                .find("label[for=payment_email_address]")
                .html("PayPal username")
                .end()
                .find("label[for=payment_email_address_confirmation]")
                .html("Confirm PayPal username");
        } else if (service === "skrill") {
            $paypalAndSkrillFields
                .removeClass("hidden")
                .find("label[for=payment_email_address]")
                .html("Skrill username")
                .end()
                .find("label[for=payment_email_address_confirmation]")
                .html("Confirm Skrill username");
        }
    };

    whichSwift = function () {
        if ($useExisting.val() === "true") {
            $existingSwift.removeClass("hidden");
        } else {
            $newSwift.removeClass("hidden");
        }
    };

    checkTax = function () {
        if (aussie.checked) {
            $taxationDetails.removeClass("hidden");

            if (hobbyistTrue.checked) {
                $taxNumbers.addClass("hidden");
            }

            if (hobbyistFalse.checked) {
                $taxNumbers.removeClass("hidden");
            }
        } else {
            $taxationDetails.addClass("hidden");
            $taxNumbers.addClass("hidden");
        }
    };

    $showNewSwift.click(function (e) {
        e.preventDefault();

        $existingSwift.addClass("hidden");
        $useExisting.val("false");
    });

    $(customAmount).on({
        change: calculateWithdrawalAmountLessFee,
        keyup: calculateWithdrawalAmountLessFee
    });

    marketplace.withdrawal = {};
    marketplace.withdrawal.check = check;
}());

// Check initial field values
marketplace.withdrawal.check();

$("form").click(function () {
    marketplace.withdrawal.check();
});

marketplace.validate.paymentRequest();