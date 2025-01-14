/*
 Highcharts JS v3.0.8 (2014-01-09)

 (c) 2009-2014 Torstein Honsi

 License: www.highcharts.com/license
 */
(function () {
    function r(a, b) {
        var c;
        a || (a = {});
        for (c in b)a[c] = b[c];
        return a
    }

    function x() {
        var a, b = arguments, c, d = {}, e = function (a, b) {
            var c, d;
            typeof a !== "object" && (a = {});
            for (d in b)b.hasOwnProperty(d) && (c = b[d], a[d] = c && typeof c === "object" && Object.prototype.toString.call(c) !== "[object Array]" && typeof c.nodeType !== "number" ? e(a[d] || {}, c) : b[d]);
            return a
        };
        b[0] === !0 && (d = b[1], b = Array.prototype.slice.call(b, 2));
        c = b.length;
        for (a = 0; a < c; a++)d = e(d, b[a]);
        return d
    }

    function z(a, b) {
        return parseInt(a, b || 10)
    }

    function da(a) {
        return typeof a ===
            "string"
    }

    function S(a) {
        return typeof a === "object"
    }

    function La(a) {
        return Object.prototype.toString.call(a) === "[object Array]"
    }

    function xa(a) {
        return typeof a === "number"
    }

    function ya(a) {
        return P.log(a) / P.LN10
    }

    function ea(a) {
        return P.pow(10, a)
    }

    function fa(a, b) {
        for (var c = a.length; c--;)if (a[c] === b) {
            a.splice(c, 1);
            break
        }
    }

    function s(a) {
        return a !== u && a !== null
    }

    function y(a, b, c) {
        var d, e;
        if (da(b))s(c) ? a.setAttribute(b, c) : a && a.getAttribute && (e = a.getAttribute(b)); else if (s(b) && S(b))for (d in b)a.setAttribute(d, b[d]);
        return e
    }

    function ka(a) {
        return La(a) ? a : [a]
    }

    function o() {
        var a = arguments, b, c, d = a.length;
        for (b = 0; b < d; b++)if (c = a[b], typeof c !== "undefined" && c !== null)return c
    }

    function D(a, b) {
        if (za && b && b.opacity !== u)b.filter = "alpha(opacity=" + b.opacity * 100 + ")";
        r(a.style, b)
    }

    function T(a, b, c, d, e) {
        a = v.createElement(a);
        b && r(a, b);
        e && D(a, {padding: 0, border: Q, margin: 0});
        c && D(a, c);
        d && d.appendChild(a);
        return a
    }

    function ga(a, b) {
        var c = function () {
        };
        c.prototype = new a;
        r(c.prototype, b);
        return c
    }

    function Ea(a, b, c, d) {
        var e = G.lang, a = +a ||
            0, f = b === -1 ? (a.toString().split(".")[1] || "").length : isNaN(b = M(b)) ? 2 : b, b = c === void 0 ? e.decimalPoint : c, d = d === void 0 ? e.thousandsSep : d, e = a < 0 ? "-" : "", c = String(z(a = M(a).toFixed(f))), g = c.length > 3 ? c.length % 3 : 0;
        return e + (g ? c.substr(0, g) + d : "") + c.substr(g).replace(/(\d{3})(?=\d)/g, "$1" + d) + (f ? b + M(a - c).toFixed(f).slice(2) : "")
    }

    function Fa(a, b) {
        return Array((b || 2) + 1 - String(a).length).join(0) + a
    }

    function Ua(a, b, c) {
        var d = a[b];
        a[b] = function () {
            var a = Array.prototype.slice.call(arguments);
            a.unshift(d);
            return c.apply(this,
                a)
        }
    }

    function Ga(a, b) {
        for (var c = "{", d = !1, e, f, g, h, i, j = []; (c = a.indexOf(c)) !== -1;) {
            e = a.slice(0, c);
            if (d) {
                f = e.split(":");
                g = f.shift().split(".");
                i = g.length;
                e = b;
                for (h = 0; h < i; h++)e = e[g[h]];
                if (f.length)f = f.join(":"), g = /\.([0-9])/, h = G.lang, i = void 0, /f$/.test(f) ? (i = (i = f.match(g)) ? i[1] : -1, e = Ea(e, i, h.decimalPoint, f.indexOf(",") > -1 ? h.thousandsSep : "")) : e = $a(f, e)
            }
            j.push(e);
            a = a.slice(c + 1);
            c = (d = !d) ? "}" : "{"
        }
        j.push(a);
        return j.join("")
    }

    function lb(a) {
        return P.pow(10, N(P.log(a) / P.LN10))
    }

    function mb(a, b, c, d) {
        var e, c = o(c,
            1);
        e = a / c;
        b || (b = [1, 2, 2.5, 5, 10], d && d.allowDecimals === !1 && (c === 1 ? b = [1, 2, 5, 10] : c <= 0.1 && (b = [1 / c])));
        for (d = 0; d < b.length; d++)if (a = b[d], e <= (b[d] + (b[d + 1] || b[d])) / 2)break;
        a *= c;
        return a
    }

    function Ab() {
        this.symbol = this.color = 0
    }

    function nb(a, b) {
        var c = a.length, d, e;
        for (e = 0; e < c; e++)a[e].ss_i = e;
        a.sort(function (a, c) {
            d = b(a, c);
            return d === 0 ? a.ss_i - c.ss_i : d
        });
        for (e = 0; e < c; e++)delete a[e].ss_i
    }

    function Ma(a) {
        for (var b = a.length, c = a[0]; b--;)a[b] < c && (c = a[b]);
        return c
    }

    function Aa(a) {
        for (var b = a.length, c = a[0]; b--;)a[b] > c && (c =
            a[b]);
        return c
    }

    function Na(a, b) {
        for (var c in a)a[c] && a[c] !== b && a[c].destroy && a[c].destroy(), delete a[c]
    }

    function Oa(a) {
        ab || (ab = T(Ha));
        a && ab.appendChild(a);
        ab.innerHTML = ""
    }

    function la(a, b) {
        var c = "Highcharts error #" + a + ": www.highcharts.com/errors/" + a;
        if (b)throw c; else C.console && console.log(c)
    }

    function ha(a) {
        return parseFloat(a.toPrecision(14))
    }

    function Pa(a, b) {
        pa = o(a, b.animation)
    }

    function Bb() {
        var a = G.global.useUTC, b = a ? "getUTC" : "get", c = a ? "setUTC" : "set";
        Qa = (a && G.global.timezoneOffset || 0) * 6E4;
        bb = a ?
            Date.UTC : function (a, b, c, g, h, i) {
            return(new Date(a, b, o(c, 1), o(g, 0), o(h, 0), o(i, 0))).getTime()
        };
        ob = b + "Minutes";
        pb = b + "Hours";
        qb = b + "Day";
        Va = b + "Date";
        cb = b + "Month";
        db = b + "FullYear";
        Cb = c + "Minutes";
        Db = c + "Hours";
        rb = c + "Date";
        Eb = c + "Month";
        Fb = c + "FullYear"
    }

    function qa() {
    }

    function Ra(a, b, c, d) {
        this.axis = a;
        this.pos = b;
        this.type = c || "";
        this.isNew = !0;
        !c && !d && this.addLabel()
    }

    function ra() {
        this.init.apply(this, arguments)
    }

    function Gb(a, b, c, d, e, f) {
        var g = a.chart.inverted;
        this.axis = a;
        this.isNegative = c;
        this.options = b;
        this.x = d;
        this.total = null;
        this.points = {};
        this.stack = e;
        this.percent = f === "percent";
        this.alignOptions = {align: b.align || (g ? c ? "left" : "right" : "center"), verticalAlign: b.verticalAlign || (g ? "middle" : c ? "bottom" : "top"), y: o(b.y, g ? 4 : c ? 14 : -6), x: o(b.x, g ? c ? -6 : 6 : 0)};
        this.textAlign = b.textAlign || (g ? c ? "right" : "left" : "center")
    }

    function sb() {
        this.init.apply(this, arguments)
    }

    function eb() {
        this.init.apply(this, arguments)
    }

    var u, v = document, C = window, P = Math, w = P.round, N = P.floor, Ia = P.ceil, t = P.max, I = P.min, M = P.abs, U = P.cos, $ = P.sin, Ba = P.PI, Ca =
            Ba * 2 / 360, sa = navigator.userAgent, Hb = C.opera, za = /msie/i.test(sa) && !Hb, fb = v.documentMode === 8, gb = /AppleWebKit/.test(sa), Wa = /Firefox/.test(sa), Ib = /(Mobile|Android|Windows Phone)/.test(sa), Da = "http://www.w3.org/2000/svg", V = !!v.createElementNS && !!v.createElementNS(Da, "svg").createSVGRect, Nb = Wa && parseInt(sa.split("Firefox/")[1], 10) < 4, ba = !V && !za && !!v.createElement("canvas").getContext, Xa, hb = v.documentElement.ontouchstart !== u, Jb = {}, tb = 0, ab, G, $a, pa, ub, E, ma = function () {
        }, Ja = [], Ha = "div", Q = "none", Ob = /^[0-9]+$/,
        Kb = "rgba(192,192,192," + (V ? 1.0E-4 : 0.002) + ")", Lb = "stroke-width", bb, Qa, ob, pb, qb, Va, cb, db, Cb, Db, rb, Eb, Fb, L = {};
    C.Highcharts = C.Highcharts ? la(16, !0) : {};
    $a = function (a, b, c) {
        if (!s(b) || isNaN(b))return"Invalid date";
        var a = o(a, "%Y-%m-%d %H:%M:%S"), d = new Date(b - Qa), e, f = d[pb](), g = d[qb](), h = d[Va](), i = d[cb](), j = d[db](), k = G.lang, l = k.weekdays, d = r({a: l[g].substr(0, 3), A: l[g], d: Fa(h), e: h, b: k.shortMonths[i], B: k.months[i], m: Fa(i + 1), y: j.toString().substr(2, 2), Y: j, H: Fa(f), I: Fa(f % 12 || 12), l: f % 12 || 12, M: Fa(d[ob]()), p: f < 12 ? "AM" :
            "PM", P: f < 12 ? "am" : "pm", S: Fa(d.getSeconds()), L: Fa(w(b % 1E3), 3)}, Highcharts.dateFormats);
        for (e in d)for (; a.indexOf("%" + e) !== -1;)a = a.replace("%" + e, typeof d[e] === "function" ? d[e](b) : d[e]);
        return c ? a.substr(0, 1).toUpperCase() + a.substr(1) : a
    };
    Ab.prototype = {wrapColor: function (a) {
        if (this.color >= a)this.color = 0
    }, wrapSymbol: function (a) {
        if (this.symbol >= a)this.symbol = 0
    }};
    E = function () {
        for (var a = 0, b = arguments, c = b.length, d = {}; a < c; a++)d[b[a++]] = b[a];
        return d
    }("millisecond", 1, "second", 1E3, "minute", 6E4, "hour", 36E5, "day",
        864E5, "week", 6048E5, "month", 26784E5, "year", 31556952E3);
    ub = {init: function (a, b, c) {
        var b = b || "", d = a.shift, e = b.indexOf("C") > -1, f = e ? 7 : 3, g, b = b.split(" "), c = [].concat(c), h, i, j = function (a) {
            for (g = a.length; g--;)a[g] === "M" && a.splice(g + 1, 0, a[g + 1], a[g + 2], a[g + 1], a[g + 2])
        };
        e && (j(b), j(c));
        a.isArea && (h = b.splice(b.length - 6, 6), i = c.splice(c.length - 6, 6));
        if (d <= c.length / f && b.length === c.length)for (; d--;)c = [].concat(c).splice(0, f).concat(c);
        a.shift = 0;
        if (b.length)for (a = c.length; b.length < a;)d = [].concat(b).splice(b.length - f,
            f), e && (d[f - 6] = d[f - 2], d[f - 5] = d[f - 1]), b = b.concat(d);
        h && (b = b.concat(h), c = c.concat(i));
        return[b, c]
    }, step: function (a, b, c, d) {
        var e = [], f = a.length;
        if (c === 1)e = d; else if (f === b.length && c < 1)for (; f--;)d = parseFloat(a[f]), e[f] = isNaN(d) ? a[f] : c * parseFloat(b[f] - d) + d; else e = b;
        return e
    }};
    (function (a) {
        C.HighchartsAdapter = C.HighchartsAdapter || a && {init: function (b) {
            var c = a.fx, d = c.step, e, f = a.Tween, g = f && f.propHooks;
            e = a.cssHooks.opacity;
            a.extend(a.easing, {easeOutQuad: function (a, b, c, d, e) {
                return-d * (b /= e) * (b - 2) + c
            }});
            a.each(["cur",
                "_default", "width", "height", "opacity"], function (a, b) {
                var e = d, k;
                b === "cur" ? e = c.prototype : b === "_default" && f && (e = g[b], b = "set");
                (k = e[b]) && (e[b] = function (c) {
                    var d, c = a ? c : this;
                    if (c.prop !== "align")return d = c.elem, d.attr ? d.attr(c.prop, b === "cur" ? u : c.now) : k.apply(this, arguments)
                })
            });
            Ua(e, "get", function (a, b, c) {
                return b.attr ? b.opacity || 0 : a.call(this, b, c)
            });
            e = function (a) {
                var c = a.elem, d;
                if (!a.started)d = b.init(c, c.d, c.toD), a.start = d[0], a.end = d[1], a.started = !0;
                c.attr("d", b.step(a.start, a.end, a.pos, c.toD))
            };
            f ? g.d = {set: e} :
                d.d = e;
            this.each = Array.prototype.forEach ? function (a, b) {
                return Array.prototype.forEach.call(a, b)
            } : function (a, b) {
                for (var c = 0, d = a.length; c < d; c++)if (b.call(a[c], a[c], c, a) === !1)return c
            };
            a.fn.highcharts = function () {
                var a = "Chart", b = arguments, c, d;
                da(b[0]) && (a = b[0], b = Array.prototype.slice.call(b, 1));
                c = b[0];
                if (c !== u)c.chart = c.chart || {}, c.chart.renderTo = this[0], new Highcharts[a](c, b[1]), d = this;
                c === u && (d = Ja[y(this[0], "data-highcharts-chart")]);
                return d
            }
        }, getScript: a.getScript, inArray: a.inArray, adapterRun: function (b, c) {
            return a(b)[c]()
        }, grep: a.grep, map: function (a, c) {
            for (var d = [], e = 0, f = a.length; e < f; e++)d[e] = c.call(a[e], a[e], e, a);
            return d
        }, offset: function (b) {
            return a(b).offset()
        }, addEvent: function (b, c, d) {
            a(b).bind(c, d)
        }, removeEvent: function (b, c, d) {
            var e = v.removeEventListener ? "removeEventListener" : "detachEvent";
            v[e] && b && !b[e] && (b[e] = function () {
            });
            a(b).unbind(c, d)
        }, fireEvent: function (b, c, d, e) {
            var f = a.Event(c), g = "detached" + c, h;
            !za && d && (delete d.layerX, delete d.layerY);
            r(f, d);
            b[c] && (b[g] = b[c], b[c] = null);
            a.each(["preventDefault",
                "stopPropagation"], function (a, b) {
                var c = f[b];
                f[b] = function () {
                    try {
                        c.call(f)
                    } catch (a) {
                        b === "preventDefault" && (h = !0)
                    }
                }
            });
            a(b).trigger(f);
            b[g] && (b[c] = b[g], b[g] = null);
            e && !f.isDefaultPrevented() && !h && e(f)
        }, washMouseEvent: function (a) {
            var c = a.originalEvent || a;
            if (c.pageX === u)c.pageX = a.pageX, c.pageY = a.pageY;
            return c
        }, animate: function (b, c, d) {
            var e = a(b);
            if (!b.style)b.style = {};
            if (c.d)b.toD = c.d, c.d = 1;
            e.stop();
            c.opacity !== u && b.attr && (c.opacity += "px");
            e.animate(c, d)
        }, stop: function (b) {
            a(b).stop()
        }}
    })(C.jQuery);
    var W =
        C.HighchartsAdapter, J = W || {};
    W && W.init.call(W, ub);
    var ib = J.adapterRun, Pb = J.getScript, ta = J.inArray, n = J.each, vb = J.grep, Qb = J.offset, Sa = J.map, F = J.addEvent, X = J.removeEvent, A = J.fireEvent, Rb = J.washMouseEvent, jb = J.animate, Ya = J.stop, J = {enabled: !0, x: 0, y: 15, style: {color: "#666", cursor: "default", fontSize: "11px", lineHeight: "14px"}};
    G = {colors: "#2f7ed8,#0d233a,#8bbc21,#910000,#1aadce,#492970,#f28f43,#77a1e5,#c42525,#a6c96a".split(","), symbols: ["circle", "diamond", "square", "triangle", "triangle-down"], lang: {loading: "Loading...",
        months: "Enero,Febrero,Marzo,Abril,May,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre".split(","), shortMonths: "Jan,Feb,Mar,Apr,May,Jun,Jul,Aug,Sep,Oct,Nov,Dec".split(","), weekdays: "Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday".split(","), decimalPoint: ".", numericSymbols: "k,M,G,T,P,E".split(","), resetZoom: "Reset zoom", resetZoomTitle: "Reset zoom level 1:1", thousandsSep: ","}, global: {useUTC: !0, canvasToolsURL: "http://code.highcharts.com/3.0.8/modules/canvas-tools.js", VMLRadialGradientURL: "http://code.highcharts.com/3.0.8/gfx/vml-radial-gradient.png"},
        chart: {borderColor: "#4572A7", borderRadius: 5, defaultSeriesType: "line", ignoreHiddenSeries: !0, spacing: [10, 10, 15, 10], style: {fontFamily: '"Lucida Grande", "Lucida Sans Unicode", Verdana, Arial, Helvetica, sans-serif', fontSize: "12px"}, backgroundColor: "#FFFFFF", plotBorderColor: "#C0C0C0", resetZoomButton: {theme: {zIndex: 20}, position: {align: "right", x: -10, y: 10}}}, title: {text: "Chart title", align: "center", margin: 15, style: {color: "#274b6d", fontSize: "16px"}}, subtitle: {text: "", align: "center", style: {color: "#4d759e"}},
        plotOptions: {line: {allowPointSelect: !1, showCheckbox: !1, animation: {duration: 1E3}, events: {}, lineWidth: 2, marker: {enabled: !0, lineWidth: 0, radius: 4, lineColor: "#FFFFFF", states: {hover: {enabled: !0}, select: {fillColor: "#FFFFFF", lineColor: "#000000", lineWidth: 2}}}, point: {events: {}}, dataLabels: x(J, {align: "center", enabled: !1, formatter: function () {
            return this.y === null ? "" : Ea(this.y, -1)
        }, verticalAlign: "bottom", y: 0}), cropThreshold: 300, pointRange: 0, states: {hover: {marker: {}}, select: {marker: {}}}, stickyTracking: !0, turboThreshold: 1E3}},
        labels: {style: {position: "absolute", color: "#3E576F"}}, legend: {enabled: !0, align: "center", layout: "horizontal", labelFormatter: function () {
            return this.name
        }, borderWidth: 1, borderColor: "#909090", borderRadius: 5, navigation: {activeColor: "#274b6d", inactiveColor: "#CCC"}, shadow: !1, itemStyle: {cursor: "pointer", color: "#274b6d", fontSize: "12px"}, itemHoverStyle: {color: "#000"}, itemHiddenStyle: {color: "#CCC"}, itemCheckboxStyle: {position: "absolute", width: "13px", height: "13px"}, symbolPadding: 5, verticalAlign: "bottom", x: 0, y: 0,
            title: {style: {fontWeight: "bold"}}}, loading: {labelStyle: {fontWeight: "bold", position: "relative", top: "1em"}, style: {position: "absolute", backgroundColor: "white", opacity: 0.5, textAlign: "center"}}, tooltip: {enabled: !0, animation: V, backgroundColor: "rgba(255, 255, 255, .85)", borderWidth: 1, borderRadius: 3, dateTimeLabelFormats: {millisecond: "%A, %b %e, %H:%M:%S.%L", second: "%A, %b %e, %H:%M:%S", minute: "%A, %b %e, %H:%M", hour: "%A, %b %e, %H:%M", day: "%A, %b %e, %Y", week: "Week from %A, %b %e, %Y", month: "%B %Y", year: "%Y"},
            headerFormat: '<span style="font-size: 10px">{point.key}</span><br/>', pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>', shadow: !0, snap: Ib ? 25 : 10, style: {color: "#333333", cursor: "default", fontSize: "12px", padding: "8px", whiteSpace: "nowrap"}}, credits: {enabled: !0, text: "", href: "http://www.highcharts.com", position: {align: "right", x: -10, verticalAlign: "bottom", y: -5}, style: {cursor: "pointer", color: "#909090", fontSize: "9px"}}};
    var Y = G.plotOptions, W = Y.line;
    Bb();
    var Sb = /rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]?(?:\.[0-9]+)?)\s*\)/, Tb = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/, Ub = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/, ua = function (a) {
        var b = [], c, d;
        (function (a) {
            a && a.stops ? d = Sa(a.stops, function (a) {
                return ua(a[1])
            }) : (c = Sb.exec(a)) ? b = [z(c[1]), z(c[2]), z(c[3]), parseFloat(c[4], 10)] : (c = Tb.exec(a)) ? b = [z(c[1], 16), z(c[2], 16), z(c[3], 16), 1] : (c = Ub.exec(a)) && (b = [z(c[1]), z(c[2]), z(c[3]), 1])
        })(a);
        return{get: function (c) {
            var f;
            d ? (f = x(a), f.stops = [].concat(f.stops), n(d, function (a, b) {
                f.stops[b] = [f.stops[b][0], a.get(c)]
            })) : f = b && !isNaN(b[0]) ? c === "rgb" ? "rgb(" + b[0] + "," + b[1] + "," + b[2] + ")" : c === "a" ? b[3] : "rgba(" + b.join(",") + ")" : a;
            return f
        }, brighten: function (a) {
            if (d)n(d, function (b) {
                b.brighten(a)
            }); else if (xa(a) && a !== 0) {
                var c;
                for (c = 0; c < 3; c++)b[c] += z(a * 255), b[c] < 0 && (b[c] = 0), b[c] > 255 && (b[c] = 255)
            }
            return this
        }, rgba: b, setOpacity: function (a) {
            b[3] = a;
            return this
        }}
    };
    qa.prototype = {init: function (a, b) {
        this.element = b === "span" ? T(b) : v.createElementNS(Da,
            b);
        this.renderer = a;
        this.attrSetters = {}
    }, opacity: 1, animate: function (a, b, c) {
        b = o(b, pa, !0);
        Ya(this);
        if (b) {
            b = x(b);
            if (c)b.complete = c;
            jb(this, a, b)
        } else this.attr(a), c && c()
    }, attr: function (a, b) {
        var c, d, e, f, g = this.element, h = g.nodeName.toLowerCase(), i = this.renderer, j, k = this.attrSetters, l = this.shadows, m, p, q = this;
        da(a) && s(b) && (c = a, a = {}, a[c] = b);
        if (da(a))c = a, h === "circle" ? c = {x: "cx", y: "cy"}[c] || c : c === "strokeWidth" && (c = "stroke-width"), q = y(g, c) || this[c] || 0, c !== "d" && c !== "visibility" && c !== "fill" && (q = parseFloat(q)); else {
            for (c in a)if (j = !1, d = a[c], e = k[c] && k[c].call(this, d, c), e !== !1) {
                e !== u && (d = e);
                if (c === "d")d && d.join && (d = d.join(" ")), /(NaN| {2}|^$)/.test(d) && (d = "M 0 0"); else if (c === "x" && h === "text")for (e = 0; e < g.childNodes.length; e++)f = g.childNodes[e], y(f, "x") === y(g, "x") && y(f, "x", d); else if (this.rotation && (c === "x" || c === "y"))p = !0; else if (c === "fill")d = i.color(d, g, c); else if (h === "circle" && (c === "x" || c === "y"))c = {x: "cx", y: "cy"}[c] || c; else if (h === "rect" && c === "r")y(g, {rx: d, ry: d}), j = !0; else if (c === "translateX" || c === "translateY" || c === "rotation" ||
                    c === "verticalAlign" || c === "scaleX" || c === "scaleY")j = p = !0; else if (c === "stroke")d = i.color(d, g, c); else if (c === "dashstyle")if (c = "stroke-dasharray", d = d && d.toLowerCase(), d === "solid")d = Q; else {
                    if (d) {
                        d = d.replace("shortdashdotdot", "3,1,1,1,1,1,").replace("shortdashdot", "3,1,1,1").replace("shortdot", "1,1,").replace("shortdash", "3,1,").replace("longdash", "8,3,").replace(/dot/g, "1,3,").replace("dash", "4,3,").replace(/,$/, "").split(",");
                        for (e = d.length; e--;)d[e] = z(d[e]) * o(a["stroke-width"], this["stroke-width"]);
                        d =
                            d.join(",")
                    }
                } else if (c === "width")d = z(d); else if (c === "align")c = "text-anchor", d = {left: "start", center: "middle", right: "end"}[d]; else if (c === "title")e = g.getElementsByTagName("title")[0], e || (e = v.createElementNS(Da, "title"), g.appendChild(e)), e.textContent = d;
                c === "strokeWidth" && (c = "stroke-width");
                if (c === "stroke-width" || c === "stroke") {
                    this[c] = d;
                    if (this.stroke && this["stroke-width"])y(g, "stroke", this.stroke), y(g, "stroke-width", this["stroke-width"]), this.hasStroke = !0; else if (c === "stroke-width" && d === 0 && this.hasStroke)g.removeAttribute("stroke"),
                        this.hasStroke = !1;
                    j = !0
                }
                this.symbolName && /^(x|y|width|height|r|start|end|innerR|anchorX|anchorY)/.test(c) && (m || (this.symbolAttr(a), m = !0), j = !0);
                if (l && /^(width|height|visibility|x|y|d|transform|cx|cy|r)$/.test(c))for (e = l.length; e--;)y(l[e], c, c === "height" ? t(d - (l[e].cutHeight || 0), 0) : d);
                if ((c === "width" || c === "height") && h === "rect" && d < 0)d = 0;
                this[c] = d;
                c === "text" ? (d !== this.textStr && delete this.bBox, this.textStr = d, this.added && i.buildText(this)) : j || y(g, c, d)
            }
            p && this.updateTransform()
        }
        return q
    }, addClass: function (a) {
        var b =
            this.element, c = y(b, "class") || "";
        c.indexOf(a) === -1 && y(b, "class", c + " " + a);
        return this
    }, symbolAttr: function (a) {
        var b = this;
        n("x,y,r,start,end,width,height,innerR,anchorX,anchorY".split(","), function (c) {
            b[c] = o(a[c], b[c])
        });
        b.attr({d: b.renderer.symbols[b.symbolName](b.x, b.y, b.width, b.height, b)})
    }, clip: function (a) {
        return this.attr("clip-path", a ? "url(" + this.renderer.url + "#" + a.id + ")" : Q)
    }, crisp: function (a, b, c, d, e) {
        var f, g = {}, h = {}, i, a = a || this.strokeWidth || this.attr && this.attr("stroke-width") || 0;
        i = w(a) % 2 / 2;
        h.x =
            N(b || this.x || 0) + i;
        h.y = N(c || this.y || 0) + i;
        h.width = N((d || this.width || 0) - 2 * i);
        h.height = N((e || this.height || 0) - 2 * i);
        h.strokeWidth = a;
        for (f in h)this[f] !== h[f] && (this[f] = g[f] = h[f]);
        return g
    }, css: function (a) {
        var b = this.element, c = this.textWidth = a && a.width && b.nodeName.toLowerCase() === "text" && z(a.width), d, e = "", f = function (a, b) {
            return"-" + b.toLowerCase()
        };
        if (a && a.color)a.fill = a.color;
        this.styles = a = r(this.styles, a);
        c && delete a.width;
        if (za && !V)D(this.element, a); else {
            for (d in a)e += d.replace(/([A-Z])/g, f) + ":" + a[d] +
                ";";
            y(b, "style", e)
        }
        c && this.added && this.renderer.buildText(this);
        return this
    }, on: function (a, b) {
        var c = this, d = c.element;
        hb && a === "click" ? (d.ontouchstart = function (a) {
            c.touchEventFired = Date.now();
            a.preventDefault();
            b.call(d, a)
        }, d.onclick = function (a) {
            (sa.indexOf("Android") === -1 || Date.now() - (c.touchEventFired || 0) > 1100) && b.call(d, a)
        }) : d["on" + a] = b;
        return this
    }, setRadialReference: function (a) {
        this.element.radialReference = a;
        return this
    }, translate: function (a, b) {
        return this.attr({translateX: a, translateY: b})
    }, invert: function () {
        this.inverted = !0;
        this.updateTransform();
        return this
    }, updateTransform: function () {
        var a = this.translateX || 0, b = this.translateY || 0, c = this.scaleX, d = this.scaleY, e = this.inverted, f = this.rotation;
        e && (a += this.attr("width"), b += this.attr("height"));
        a = ["translate(" + a + "," + b + ")"];
        e ? a.push("rotate(90) scale(-1,1)") : f && a.push("rotate(" + f + " " + (this.x || 0) + " " + (this.y || 0) + ")");
        (s(c) || s(d)) && a.push("scale(" + o(c, 1) + " " + o(d, 1) + ")");
        a.length && y(this.element, "transform", a.join(" "))
    }, toFront: function () {
        var a = this.element;
        a.parentNode.appendChild(a);
        return this
    }, align: function (a, b, c) {
        var d, e, f, g, h = {};
        e = this.renderer;
        f = e.alignedObjects;
        if (a) {
            if (this.alignOptions = a, this.alignByTranslate = b, !c || da(c))this.alignTo = d = c || "renderer", fa(f, this), f.push(this), c = null
        } else a = this.alignOptions, b = this.alignByTranslate, d = this.alignTo;
        c = o(c, e[d], e);
        d = a.align;
        e = a.verticalAlign;
        f = (c.x || 0) + (a.x || 0);
        g = (c.y || 0) + (a.y || 0);
        if (d === "right" || d === "center")f += (c.width - (a.width || 0)) / {right: 1, center: 2}[d];
        h[b ? "translateX" : "x"] = w(f);
        if (e === "bottom" || e === "middle")g += (c.height -
            (a.height || 0)) / ({bottom: 1, middle: 2}[e] || 1);
        h[b ? "translateY" : "y"] = w(g);
        this[this.placed ? "animate" : "attr"](h);
        this.placed = !0;
        this.alignAttr = h;
        return this
    }, getBBox: function () {
        var a = this.bBox, b = this.renderer, c, d, e = this.rotation;
        c = this.element;
        var f = this.styles, g = e * Ca;
        d = this.textStr;
        var h;
        if (d === "" || Ob.test(d))h = d.length + "|" + f.fontSize + "|" + f.fontFamily, a = b.cache[h];
        if (!a) {
            if (c.namespaceURI === Da || b.forExport) {
                try {
                    a = c.getBBox ? r({}, c.getBBox()) : {width: c.offsetWidth, height: c.offsetHeight}
                } catch (i) {
                }
                if (!a ||
                    a.width < 0)a = {width: 0, height: 0}
            } else a = this.htmlGetBBox();
            if (b.isSVG) {
                c = a.width;
                d = a.height;
                if (za && f && f.fontSize === "11px" && d.toPrecision(3) === "22.7")a.height = d = 14;
                if (e)a.width = M(d * $(g)) + M(c * U(g)), a.height = M(d * U(g)) + M(c * $(g))
            }
            this.bBox = a;
            h && (b.cache[h] = a)
        }
        return a
    }, show: function () {
        return this.attr({visibility: "visible"})
    }, hide: function () {
        return this.attr({visibility: "hidden"})
    }, fadeOut: function (a) {
        var b = this;
        b.animate({opacity: 0}, {duration: a || 150, complete: function () {
            b.hide()
        }})
    }, add: function (a) {
        var b =
            this.renderer, c = a || b, d = c.element || b.box, e = d.childNodes, f = this.element, g = y(f, "zIndex"), h;
        if (a)this.parentGroup = a;
        this.parentInverted = a && a.inverted;
        this.textStr !== void 0 && b.buildText(this);
        if (g)c.handleZ = !0, g = z(g);
        if (c.handleZ)for (c = 0; c < e.length; c++)if (a = e[c], b = y(a, "zIndex"), a !== f && (z(b) > g || !s(g) && s(b))) {
            d.insertBefore(f, a);
            h = !0;
            break
        }
        h || d.appendChild(f);
        this.added = !0;
        A(this, "add");
        return this
    }, safeRemoveChild: function (a) {
        var b = a.parentNode;
        b && b.removeChild(a)
    }, destroy: function () {
        var a = this, b = a.element ||
        {}, c = a.shadows, d = a.renderer.isSVG && b.nodeName === "SPAN" && a.parentGroup, e, f;
        b.onclick = b.onmouseout = b.onmouseover = b.onmousemove = b.point = null;
        Ya(a);
        if (a.clipPath)a.clipPath = a.clipPath.destroy();
        if (a.stops) {
            for (f = 0; f < a.stops.length; f++)a.stops[f] = a.stops[f].destroy();
            a.stops = null
        }
        a.safeRemoveChild(b);
        for (c && n(c, function (b) {
            a.safeRemoveChild(b)
        }); d && d.div.childNodes.length === 0;)b = d.parentGroup, a.safeRemoveChild(d.div), delete d.div, d = b;
        a.alignTo && fa(a.renderer.alignedObjects, a);
        for (e in a)delete a[e];
        return null
    },
        shadow: function (a, b, c) {
            var d = [], e, f, g = this.element, h, i, j, k;
            if (a) {
                i = o(a.width, 3);
                j = (a.opacity || 0.15) / i;
                k = this.parentInverted ? "(-1,-1)" : "(" + o(a.offsetX, 1) + ", " + o(a.offsetY, 1) + ")";
                for (e = 1; e <= i; e++) {
                    f = g.cloneNode(0);
                    h = i * 2 + 1 - 2 * e;
                    y(f, {isShadow: "true", stroke: a.color || "black", "stroke-opacity": j * e, "stroke-width": h, transform: "translate" + k, fill: Q});
                    if (c)y(f, "height", t(y(f, "height") - h, 0)), f.cutHeight = h;
                    b ? b.element.appendChild(f) : g.parentNode.insertBefore(f, g);
                    d.push(f)
                }
                this.shadows = d
            }
            return this
        }};
    var va = function () {
        this.init.apply(this,
            arguments)
    };
    va.prototype = {Element: qa, init: function (a, b, c, d) {
        var e = location, f, g;
        f = this.createElement("svg").attr({version: "1.1"});
        g = f.element;
        a.appendChild(g);
        a.innerHTML.indexOf("xmlns") === -1 && y(g, "xmlns", Da);
        this.isSVG = !0;
        this.box = g;
        this.boxWrapper = f;
        this.alignedObjects = [];
        this.url = (Wa || gb) && v.getElementsByTagName("base").length ? e.href.replace(/#.*?$/, "").replace(/([\('\)])/g, "\\$1").replace(/ /g, "%20") : "";
        this.createElement("desc").add().element.appendChild(v.createTextNode("Created with Highcharts 3.0.8"));
        this.defs = this.createElement("defs").add();
        this.forExport = d;
        this.gradients = {};
        this.cache = {};
        this.setSize(b, c, !1);
        var h;
        if (Wa && a.getBoundingClientRect)this.subPixelFix = b = function () {
            D(a, {left: 0, top: 0});
            h = a.getBoundingClientRect();
            D(a, {left: Ia(h.left) - h.left + "px", top: Ia(h.top) - h.top + "px"})
        }, b(), F(C, "resize", b)
    }, isHidden: function () {
        return!this.boxWrapper.getBBox().width
    }, destroy: function () {
        var a = this.defs;
        this.box = null;
        this.boxWrapper = this.boxWrapper.destroy();
        Na(this.gradients || {});
        this.gradients = null;
        if (a)this.defs = a.destroy();
        this.subPixelFix && X(C, "resize", this.subPixelFix);
        return this.alignedObjects = null
    }, createElement: function (a) {
        var b = new this.Element;
        b.init(this, a);
        return b
    }, draw: function () {
    }, buildText: function (a) {
        for (var b = a.element, c = this, d = c.forExport, e = o(a.textStr, "").toString().replace(/<(b|strong)>/g, '<span style="font-weight:bold">').replace(/<(i|em)>/g, '<span style="font-style:italic">').replace(/<a/g, "<span").replace(/<\/(b|strong|i|em|a)>/g, "</span>").split(/<br.*?>/g), f = b.childNodes,
                 g = /style="([^"]+)"/, h = /href="(http[^"]+)"/, i = y(b, "x"), j = a.styles, k = a.textWidth, l = j && j.lineHeight, m = f.length; m--;)b.removeChild(f[m]);
        k && !a.added && this.box.appendChild(b);
        e[e.length - 1] === "" && e.pop();
        n(e, function (e, f) {
            var m, o = 0, e = e.replace(/<span/g, "|||<span").replace(/<\/span>/g, "</span>|||");
            m = e.split("|||");
            n(m, function (e) {
                if (e !== "" || m.length === 1) {
                    var p = {}, n = v.createElementNS(Da, "tspan"), s;
                    g.test(e) && (s = e.match(g)[1].replace(/(;| |^)color([ :])/, "$1fill$2"), y(n, "style", s));
                    h.test(e) && !d && (y(n, "onclick",
                            'location.href="' + e.match(h)[1] + '"'), D(n, {cursor: "pointer"}));
                    e = (e.replace(/<(.|\n)*?>/g, "") || " ").replace(/&lt;/g, "<").replace(/&gt;/g, ">");
                    if (e !== " " && (n.appendChild(v.createTextNode(e)), o ? p.dx = 0 : p.x = i, y(n, p), !o && f && (!V && d && D(n, {display: "block"}), y(n, "dy", l || c.fontMetrics(/px$/.test(n.style.fontSize) ? n.style.fontSize : j.fontSize).h, gb && n.offsetHeight)), b.appendChild(n), o++, k))for (var e = e.replace(/([^\^])-/g, "$1- ").split(" "), p = e.length > 1 && j.whiteSpace !== "nowrap", t, w, u = a._clipHeight, r = [], B = z(l ||
                        16), x = 1; p && (e.length || r.length);)delete a.bBox, t = a.getBBox(), w = t.width, !V && c.forExport && (w = c.measureSpanWidth(n.firstChild.data, a.styles)), t = w > k, !t || e.length === 1 ? (e = r, r = [], e.length && (x++, u && x * B > u ? (e = ["..."], a.attr("title", a.textStr)) : (n = v.createElementNS(Da, "tspan"), y(n, {dy: B, x: i}), s && y(n, "style", s), b.appendChild(n), w > k && (k = w)))) : (n.removeChild(n.firstChild), r.unshift(e.pop())), e.length && n.appendChild(v.createTextNode(e.join(" ").replace(/- /g, "-")))
                }
            })
        })
    }, button: function (a, b, c, d, e, f, g, h, i) {
        var j =
            this.label(a, b, c, i, null, null, null, null, "button"), k = 0, l, m, p, q, n, o, a = {x1: 0, y1: 0, x2: 0, y2: 1}, e = x({"stroke-width": 1, stroke: "#CCCCCC", fill: {linearGradient: a, stops: [
            [0, "#FEFEFE"],
            [1, "#F6F6F6"]
        ]}, r: 2, padding: 5, style: {color: "black"}}, e);
        p = e.style;
        delete e.style;
        f = x(e, {stroke: "#68A", fill: {linearGradient: a, stops: [
            [0, "#FFF"],
            [1, "#ACF"]
        ]}}, f);
        q = f.style;
        delete f.style;
        g = x(e, {stroke: "#68A", fill: {linearGradient: a, stops: [
            [0, "#9BD"],
            [1, "#CDF"]
        ]}}, g);
        n = g.style;
        delete g.style;
        h = x(e, {style: {color: "#CCC"}}, h);
        o = h.style;
        delete h.style;
        F(j.element, za ? "mouseover" : "mouseenter", function () {
            k !== 3 && j.attr(f).css(q)
        });
        F(j.element, za ? "mouseout" : "mouseleave", function () {
            k !== 3 && (l = [e, f, g][k], m = [p, q, n][k], j.attr(l).css(m))
        });
        j.setState = function (a) {
            (j.state = k = a) ? a === 2 ? j.attr(g).css(n) : a === 3 && j.attr(h).css(o) : j.attr(e).css(p)
        };
        return j.on("click", function () {
            k !== 3 && d.call(j)
        }).attr(e).css(r({cursor: "default"}, p))
    }, crispLine: function (a, b) {
        a[1] === a[4] && (a[1] = a[4] = w(a[1]) - b % 2 / 2);
        a[2] === a[5] && (a[2] = a[5] = w(a[2]) + b % 2 / 2);
        return a
    }, path: function (a) {
        var b =
        {fill: Q};
        La(a) ? b.d = a : S(a) && r(b, a);
        return this.createElement("path").attr(b)
    }, circle: function (a, b, c) {
        a = S(a) ? a : {x: a, y: b, r: c};
        return this.createElement("circle").attr(a)
    }, arc: function (a, b, c, d, e, f) {
        if (S(a))b = a.y, c = a.r, d = a.innerR, e = a.start, f = a.end, a = a.x;
        a = this.symbol("arc", a || 0, b || 0, c || 0, c || 0, {innerR: d || 0, start: e || 0, end: f || 0});
        a.r = c;
        return a
    }, rect: function (a, b, c, d, e, f) {
        e = S(a) ? a.r : e;
        e = this.createElement("rect").attr({rx: e, ry: e, fill: Q});
        return e.attr(S(a) ? a : e.crisp(f, a, b, t(c, 0), t(d, 0)))
    }, setSize: function (a, b, c) {
        var d = this.alignedObjects, e = d.length;
        this.width = a;
        this.height = b;
        for (this.boxWrapper[o(c, !0) ? "animate" : "attr"]({width: a, height: b}); e--;)d[e].align()
    }, g: function (a) {
        var b = this.createElement("g");
        return s(a) ? b.attr({"class": "highcharts-" + a}) : b
    }, image: function (a, b, c, d, e) {
        var f = {preserveAspectRatio: Q};
        arguments.length > 1 && r(f, {x: b, y: c, width: d, height: e});
        f = this.createElement("image").attr(f);
        f.element.setAttributeNS ? f.element.setAttributeNS("http://www.w3.org/1999/xlink", "href", a) : f.element.setAttribute("hc-svg-href",
            a);
        return f
    }, symbol: function (a, b, c, d, e, f) {
        var g, h = this.symbols[a], h = h && h(w(b), w(c), d, e, f), i = /^url\((.*?)\)$/, j, k;
        if (h)g = this.path(h), r(g, {symbolName: a, x: b, y: c, width: d, height: e}), f && r(g, f); else if (i.test(a))k = function (a, b) {
            a.element && (a.attr({width: b[0], height: b[1]}), a.alignByTranslate || a.translate(w((d - b[0]) / 2), w((e - b[1]) / 2)))
        }, j = a.match(i)[1], a = Jb[j], g = this.image(j).attr({x: b, y: c}), g.isImg = !0, a ? k(g, a) : (g.attr({width: 0, height: 0}), T("img", {onload: function () {
            k(g, Jb[j] = [this.width, this.height])
        }, src: j}));
        return g
    }, symbols: {circle: function (a, b, c, d) {
        var e = 0.166 * c;
        return["M", a + c / 2, b, "C", a + c + e, b, a + c + e, b + d, a + c / 2, b + d, "C", a - e, b + d, a - e, b, a + c / 2, b, "Z"]
    }, square: function (a, b, c, d) {
        return["M", a, b, "L", a + c, b, a + c, b + d, a, b + d, "Z"]
    }, triangle: function (a, b, c, d) {
        return["M", a + c / 2, b, "L", a + c, b + d, a, b + d, "Z"]
    }, "triangle-down": function (a, b, c, d) {
        return["M", a, b, "L", a + c, b, a + c / 2, b + d, "Z"]
    }, diamond: function (a, b, c, d) {
        return["M", a + c / 2, b, "L", a + c, b + d / 2, a + c / 2, b + d, a, b + d / 2, "Z"]
    }, arc: function (a, b, c, d, e) {
        var f = e.start, c = e.r || c || d, g = e.end - 0.001,
            d = e.innerR, h = e.open, i = U(f), j = $(f), k = U(g), g = $(g), e = e.end - f < Ba ? 0 : 1;
        return["M", a + c * i, b + c * j, "A", c, c, 0, e, 1, a + c * k, b + c * g, h ? "M" : "L", a + d * k, b + d * g, "A", d, d, 0, e, 0, a + d * i, b + d * j, h ? "" : "Z"]
    }}, clipRect: function (a, b, c, d) {
        var e = "highcharts-" + tb++, f = this.createElement("clipPath").attr({id: e}).add(this.defs), a = this.rect(a, b, c, d, 0).add(f);
        a.id = e;
        a.clipPath = f;
        return a
    }, color: function (a, b, c) {
        var d = this, e, f = /^rgba/, g, h, i, j, k, l, m, p = [];
        a && a.linearGradient ? g = "linearGradient" : a && a.radialGradient && (g = "radialGradient");
        if (g) {
            c = a[g];
            h = d.gradients;
            j = a.stops;
            b = b.radialReference;
            La(c) && (a[g] = c = {x1: c[0], y1: c[1], x2: c[2], y2: c[3], gradientUnits: "userSpaceOnUse"});
            g === "radialGradient" && b && !s(c.gradientUnits) && (c = x(c, {cx: b[0] - b[2] / 2 + c.cx * b[2], cy: b[1] - b[2] / 2 + c.cy * b[2], r: c.r * b[2], gradientUnits: "userSpaceOnUse"}));
            for (m in c)m !== "id" && p.push(m, c[m]);
            for (m in j)p.push(j[m]);
            p = p.join(",");
            h[p] ? a = h[p].id : (c.id = a = "highcharts-" + tb++, h[p] = i = d.createElement(g).attr(c).add(d.defs), i.stops = [], n(j, function (a) {
                f.test(a[1]) ? (e = ua(a[1]), k = e.get("rgb"),
                    l = e.get("a")) : (k = a[1], l = 1);
                a = d.createElement("stop").attr({offset: a[0], "stop-color": k, "stop-opacity": l}).add(i);
                i.stops.push(a)
            }));
            return"url(" + d.url + "#" + a + ")"
        } else return f.test(a) ? (e = ua(a), y(b, c + "-opacity", e.get("a")), e.get("rgb")) : (b.removeAttribute(c + "-opacity"), a)
    }, text: function (a, b, c, d) {
        var e = G.chart.style, f = ba || !V && this.forExport;
        if (d && !this.forExport)return this.html(a, b, c);
        b = w(o(b, 0));
        c = w(o(c, 0));
        a = this.createElement("text").attr({x: b, y: c, text: a}).css({fontFamily: e.fontFamily, fontSize: e.fontSize});
        f && a.css({position: "absolute"});
        a.x = b;
        a.y = c;
        return a
    }, fontMetrics: function (a) {
        var a = z(a || 11), a = a < 24 ? a + 4 : w(a * 1.2), b = w(a * 0.8);
        return{h: a, b: b}
    }, label: function (a, b, c, d, e, f, g, h, i) {
        function j() {
            var a, b;
            a = o.element.style;
            wa = (ia === void 0 || wb === void 0 || q.styles.textAlign) && o.getBBox();
            q.width = (ia || wa.width || 0) + 2 * ca + kb;
            q.height = (wb || wa.height || 0) + 2 * ca;
            ja = ca + p.fontMetrics(a && a.fontSize).b;
            if (v) {
                if (!H)a = w(-t * ca), b = h ? -ja : 0, q.box = H = d ? p.symbol(d, a, b, q.width, q.height, y) : p.rect(a, b, q.width, q.height, 0, y[Lb]), H.add(q);
                H.isImg || H.attr(x({width: q.width, height: q.height}, y));
                y = null
            }
        }

        function k() {
            var a = q.styles, a = a && a.textAlign, b = kb + ca * (1 - t), c;
            c = h ? 0 : ja;
            if (s(ia) && (a === "center" || a === "right"))b += {center: 0.5, right: 1}[a] * (ia - wa.width);
            (b !== o.x || c !== o.y) && o.attr({x: b, y: c});
            o.x = b;
            o.y = c
        }

        function l(a, b) {
            H ? H.attr(a, b) : y[a] = b
        }

        function m() {
            o.add(q);
            q.attr({text: a, x: b, y: c});
            H && s(e) && q.attr({anchorX: e, anchorY: f})
        }

        var p = this, q = p.g(i), o = p.text("", 0, 0, g).attr({zIndex: 1}), H, wa, t = 0, ca = 3, kb = 0, ia, wb, Z, K, B = 0, y = {}, ja, g = q.attrSetters, v;
        F(q,
            "add", m);
        g.width = function (a) {
            ia = a;
            return!1
        };
        g.height = function (a) {
            wb = a;
            return!1
        };
        g.padding = function (a) {
            s(a) && a !== ca && (ca = a, k());
            return!1
        };
        g.paddingLeft = function (a) {
            s(a) && a !== kb && (kb = a, k());
            return!1
        };
        g.align = function (a) {
            t = {left: 0, center: 0.5, right: 1}[a];
            return!1
        };
        g.text = function (a, b) {
            o.attr(b, a);
            j();
            k();
            return!1
        };
        g[Lb] = function (a, b) {
            v = !0;
            B = a % 2 / 2;
            l(b, a);
            return!1
        };
        g.stroke = g.fill = g.r = function (a, b) {
            b === "fill" && (v = !0);
            l(b, a);
            return!1
        };
        g.anchorX = function (a, b) {
            e = a;
            l(b, a + B - Z);
            return!1
        };
        g.anchorY = function (a, b) {
            f = a;
            l(b, a - K);
            return!1
        };
        g.x = function (a) {
            q.x = a;
            a -= t * ((ia || wa.width) + ca);
            Z = w(a);
            q.attr("translateX", Z);
            return!1
        };
        g.y = function (a) {
            K = q.y = w(a);
            q.attr("translateY", K);
            return!1
        };
        var z = q.css;
        return r(q, {css: function (a) {
            if (a) {
                var b = {}, a = x(a);
                n("fontSize,fontWeight,fontFamily,color,lineHeight,width,textDecoration,textShadow".split(","), function (c) {
                    a[c] !== u && (b[c] = a[c], delete a[c])
                });
                o.css(b)
            }
            return z.call(q, a)
        }, getBBox: function () {
            return{width: wa.width + 2 * ca, height: wa.height + 2 * ca, x: wa.x - ca, y: wa.y - ca}
        }, shadow: function (a) {
            H &&
            H.shadow(a);
            return q
        }, destroy: function () {
            X(q, "add", m);
            X(q.element, "mouseenter");
            X(q.element, "mouseleave");
            o && (o = o.destroy());
            H && (H = H.destroy());
            qa.prototype.destroy.call(q);
            q = p = j = k = l = m = null
        }})
    }};
    Xa = va;
    r(qa.prototype, {htmlCss: function (a) {
        var b = this.element;
        if (b = a && b.tagName === "SPAN" && a.width)delete a.width, this.textWidth = b, this.updateTransform();
        this.styles = r(this.styles, a);
        D(this.element, a);
        return this
    }, htmlGetBBox: function () {
        var a = this.element, b = this.bBox;
        if (!b) {
            if (a.nodeName === "text")a.style.position =
                "absolute";
            b = this.bBox = {x: a.offsetLeft, y: a.offsetTop, width: a.offsetWidth, height: a.offsetHeight}
        }
        return b
    }, htmlUpdateTransform: function () {
        if (this.added) {
            var a = this.renderer, b = this.element, c = this.translateX || 0, d = this.translateY || 0, e = this.x || 0, f = this.y || 0, g = this.textAlign || "left", h = {left: 0, center: 0.5, right: 1}[g], i = this.shadows;
            D(b, {marginLeft: c, marginTop: d});
            i && n(i, function (a) {
                D(a, {marginLeft: c + 1, marginTop: d + 1})
            });
            this.inverted && n(b.childNodes, function (c) {
                a.invertChild(c, b)
            });
            if (b.tagName === "SPAN") {
                var j =
                    this.rotation, k, l = z(this.textWidth), m = [j, g, b.innerHTML, this.textWidth].join(",");
                if (m !== this.cTT) {
                    k = a.fontMetrics(b.style.fontSize).b;
                    s(j) && this.setSpanRotation(j, h, k);
                    i = o(this.elemWidth, b.offsetWidth);
                    if (i > l && /[ \-]/.test(b.textContent || b.innerText))D(b, {width: l + "px", display: "block", whiteSpace: "normal"}), i = l;
                    this.getSpanCorrection(i, k, h, j, g)
                }
                D(b, {left: e + (this.xCorr || 0) + "px", top: f + (this.yCorr || 0) + "px"});
                if (gb)k = b.offsetHeight;
                this.cTT = m
            }
        } else this.alignOnAdd = !0
    }, setSpanRotation: function (a, b, c) {
        var d =
        {}, e = za ? "-ms-transform" : gb ? "-webkit-transform" : Wa ? "MozTransform" : Hb ? "-o-transform" : "";
        d[e] = d.transform = "rotate(" + a + "deg)";
        d[e + (Wa ? "Origin" : "-origin")] = b * 100 + "% " + c + "px";
        D(this.element, d)
    }, getSpanCorrection: function (a, b, c) {
        this.xCorr = -a * c;
        this.yCorr = -b
    }});
    r(va.prototype, {html: function (a, b, c) {
        var d = G.chart.style, e = this.createElement("span"), f = e.attrSetters, g = e.element, h = e.renderer;
        f.text = function (a) {
            a !== g.innerHTML && delete this.bBox;
            g.innerHTML = a;
            return!1
        };
        f.x = f.y = f.align = f.rotation = function (a, b) {
            b ===
            "align" && (b = "textAlign");
            e[b] = a;
            e.htmlUpdateTransform();
            return!1
        };
        e.attr({text: a, x: w(b), y: w(c)}).css({position: "absolute", whiteSpace: "nowrap", fontFamily: d.fontFamily, fontSize: d.fontSize});
        e.css = e.htmlCss;
        if (h.isSVG)e.add = function (a) {
            var b, c = h.box.parentNode, d = [];
            if (this.parentGroup = a) {
                if (b = a.div, !b) {
                    for (; a;)d.push(a), a = a.parentGroup;
                    n(d.reverse(), function (a) {
                        var d;
                        b = a.div = a.div || T(Ha, {className: y(a.element, "class")}, {position: "absolute", left: (a.translateX || 0) + "px", top: (a.translateY || 0) + "px"}, b || c);
                        d = b.style;
                        r(a.attrSetters, {translateX: function (a) {
                            d.left = a + "px"
                        }, translateY: function (a) {
                            d.top = a + "px"
                        }, visibility: function (a, b) {
                            d[b] = a
                        }})
                    })
                }
            } else b = c;
            b.appendChild(g);
            e.added = !0;
            e.alignOnAdd && e.htmlUpdateTransform();
            return e
        };
        return e
    }});
    var R;
    if (!V && !ba) {
        Highcharts.VMLElement = R = {init: function (a, b) {
            var c = ["<", b, ' filled="f" stroked="f"'], d = ["position: ", "absolute", ";"], e = b === Ha;
            (b === "shape" || e) && d.push("left:0;top:0;width:1px;height:1px;");
            d.push("visibility: ", e ? "hidden" : "visible");
            c.push(' style="',
                d.join(""), '"/>');
            if (b)c = e || b === "span" || b === "img" ? c.join("") : a.prepVML(c), this.element = T(c);
            this.renderer = a;
            this.attrSetters = {}
        }, add: function (a) {
            var b = this.renderer, c = this.element, d = b.box, d = a ? a.element || a : d;
            a && a.inverted && b.invertChild(c, d);
            d.appendChild(c);
            this.added = !0;
            this.alignOnAdd && !this.deferUpdateTransform && this.updateTransform();
            A(this, "add");
            return this
        }, updateTransform: qa.prototype.htmlUpdateTransform, setSpanRotation: function () {
            var a = this.rotation, b = U(a * Ca), c = $(a * Ca);
            D(this.element, {filter: a ?
                ["progid:DXImageTransform.Microsoft.Matrix(M11=", b, ", M12=", -c, ", M21=", c, ", M22=", b, ", sizingMethod='auto expand')"].join("") : Q})
        }, getSpanCorrection: function (a, b, c, d, e) {
            var f = d ? U(d * Ca) : 1, g = d ? $(d * Ca) : 0, h = o(this.elemHeight, this.element.offsetHeight), i;
            this.xCorr = f < 0 && -a;
            this.yCorr = g < 0 && -h;
            i = f * g < 0;
            this.xCorr += g * b * (i ? 1 - c : c);
            this.yCorr -= f * b * (d ? i ? c : 1 - c : 1);
            e && e !== "left" && (this.xCorr -= a * c * (f < 0 ? -1 : 1), d && (this.yCorr -= h * c * (g < 0 ? -1 : 1)), D(this.element, {textAlign: e}))
        }, pathToVML: function (a) {
            for (var b = a.length,
                     c = []; b--;)if (xa(a[b]))c[b] = w(a[b] * 10) - 5; else if (a[b] === "Z")c[b] = "x"; else if (c[b] = a[b], a.isArc && (a[b] === "wa" || a[b] === "at"))c[b + 5] === c[b + 7] && (c[b + 7] += a[b + 7] > a[b + 5] ? 1 : -1), c[b + 6] === c[b + 8] && (c[b + 8] += a[b + 8] > a[b + 6] ? 1 : -1);
            return c.join(" ") || "x"
        }, attr: function (a, b) {
            var c, d, e, f = this.element || {}, g = f.style, h = f.nodeName, i = this.renderer, j = this.symbolName, k, l = this.shadows, m, p = this.attrSetters, q = this;
            da(a) && s(b) && (c = a, a = {}, a[c] = b);
            if (da(a))c = a, q = c === "strokeWidth" || c === "stroke-width" ? this.strokeweight : this[c]; else for (c in a)if (d =
                a[c], m = !1, e = p[c] && p[c].call(this, d, c), e !== !1 && d !== null) {
                e !== u && (d = e);
                if (j && /^(x|y|r|start|end|width|height|innerR|anchorX|anchorY)/.test(c))k || (this.symbolAttr(a), k = !0), m = !0; else if (c === "d") {
                    d = d || [];
                    this.d = d.join(" ");
                    f.path = d = this.pathToVML(d);
                    if (l)for (e = l.length; e--;)l[e].path = l[e].cutOff ? this.cutOffPath(d, l[e].cutOff) : d;
                    m = !0
                } else if (c === "visibility") {
                    if (l)for (e = l.length; e--;)l[e].style[c] = d;
                    h === "DIV" && (d = d === "hidden" ? "-999em" : 0, fb || (g[c] = d ? "visible" : "hidden"), c = "top");
                    g[c] = d;
                    m = !0
                } else if (c === "zIndex")d &&
                (g[c] = d), m = !0; else if (ta(c, ["x", "y", "width", "height"]) !== -1)this[c] = d, c === "x" || c === "y" ? c = {x: "left", y: "top"}[c] : d = t(0, d), this.updateClipping ? (this[c] = d, this.updateClipping()) : g[c] = d, m = !0; else if (c === "class" && h === "DIV")f.className = d; else if (c === "stroke")d = i.color(d, f, c), c = "strokecolor"; else if (c === "stroke-width" || c === "strokeWidth")f.stroked = d ? !0 : !1, c = "strokeweight", this[c] = d, xa(d) && (d += "px"); else if (c === "dashstyle")(f.getElementsByTagName("stroke")[0] || T(i.prepVML(["<stroke/>"]), null, null, f))[c] = d ||
                    "solid", this.dashstyle = d, m = !0; else if (c === "fill")if (h === "SPAN")g.color = d; else {
                    if (h !== "IMG")f.filled = d !== Q ? !0 : !1, d = i.color(d, f, c, this), c = "fillcolor"
                } else if (c === "opacity")m = !0; else if (h === "shape" && c === "rotation")this[c] = f.style[c] = d, f.style.left = -w($(d * Ca) + 1) + "px", f.style.top = w(U(d * Ca)) + "px"; else if (c === "translateX" || c === "translateY" || c === "rotation")this[c] = d, this.updateTransform(), m = !0;
                m || (fb ? f[c] = d : y(f, c, d))
            }
            return q
        }, clip: function (a) {
            var b = this, c;
            a ? (c = a.members, fa(c, b), c.push(b), b.destroyClip = function () {
                fa(c,
                    b)
            }, a = a.getCSS(b)) : (b.destroyClip && b.destroyClip(), a = {clip: fb ? "inherit" : "rect(auto)"});
            return b.css(a)
        }, css: qa.prototype.htmlCss, safeRemoveChild: function (a) {
            a.parentNode && Oa(a)
        }, destroy: function () {
            this.destroyClip && this.destroyClip();
            return qa.prototype.destroy.apply(this)
        }, on: function (a, b) {
            this.element["on" + a] = function () {
                var a = C.event;
                a.target = a.srcElement;
                b(a)
            };
            return this
        }, cutOffPath: function (a, b) {
            var c, a = a.split(/[ ,]/);
            c = a.length;
            if (c === 9 || c === 11)a[c - 4] = a[c - 2] = z(a[c - 2]) - 10 * b;
            return a.join(" ")
        },
            shadow: function (a, b, c) {
                var d = [], e, f = this.element, g = this.renderer, h, i = f.style, j, k = f.path, l, m, p, q;
                k && typeof k.value !== "string" && (k = "x");
                m = k;
                if (a) {
                    p = o(a.width, 3);
                    q = (a.opacity || 0.15) / p;
                    for (e = 1; e <= 3; e++) {
                        l = p * 2 + 1 - 2 * e;
                        c && (m = this.cutOffPath(k.value, l + 0.5));
                        j = ['<shape isShadow="true" strokeweight="', l, '" filled="false" path="', m, '" coordsize="10 10" style="', f.style.cssText, '" />'];
                        h = T(g.prepVML(j), null, {left: z(i.left) + o(a.offsetX, 1), top: z(i.top) + o(a.offsetY, 1)});
                        if (c)h.cutOff = l + 1;
                        j = ['<stroke color="', a.color ||
                            "black", '" opacity="', q * e, '"/>'];
                        T(g.prepVML(j), null, null, h);
                        b ? b.element.appendChild(h) : f.parentNode.insertBefore(h, f);
                        d.push(h)
                    }
                    this.shadows = d
                }
                return this
            }};
        R = ga(qa, R);
        var xb = {Element: R, isIE8: sa.indexOf("MSIE 8.0") > -1, init: function (a, b, c) {
            var d, e;
            this.alignedObjects = [];
            d = this.createElement(Ha);
            e = d.element;
            e.style.position = "relative";
            a.appendChild(d.element);
            this.isVML = !0;
            this.box = e;
            this.boxWrapper = d;
            this.cache = {};
            this.setSize(b, c, !1);
            if (!v.namespaces.hcv) {
                v.namespaces.add("hcv", "urn:schemas-microsoft-com:vml");
                try {
                    v.createStyleSheet().cssText = "hcv\\:fill, hcv\\:path, hcv\\:shape, hcv\\:stroke{ behavior:url(#default#VML); display: inline-block; } "
                } catch (f) {
                    v.styleSheets[0].cssText += "hcv\\:fill, hcv\\:path, hcv\\:shape, hcv\\:stroke{ behavior:url(#default#VML); display: inline-block; } "
                }
            }
        }, isHidden: function () {
            return!this.box.offsetWidth
        }, clipRect: function (a, b, c, d) {
            var e = this.createElement(), f = S(a);
            return r(e, {members: [], left: (f ? a.x : a) + 1, top: (f ? a.y : b) + 1, width: (f ? a.width : c) - 1, height: (f ? a.height : d) - 1, getCSS: function (a) {
                var b =
                    a.element, c = b.nodeName, a = a.inverted, d = this.top - (c === "shape" ? b.offsetTop : 0), e = this.left, b = e + this.width, f = d + this.height, d = {clip: "rect(" + w(a ? e : d) + "px," + w(a ? f : b) + "px," + w(a ? b : f) + "px," + w(a ? d : e) + "px)"};
                !a && fb && c === "DIV" && r(d, {width: b + "px", height: f + "px"});
                return d
            }, updateClipping: function () {
                n(e.members, function (a) {
                    a.css(e.getCSS(a))
                })
            }})
        }, color: function (a, b, c, d) {
            var e = this, f, g = /^rgba/, h, i, j = Q;
            a && a.linearGradient ? i = "gradient" : a && a.radialGradient && (i = "pattern");
            if (i) {
                var k, l, m = a.linearGradient || a.radialGradient,
                    p, q, o, H, t, s = "", a = a.stops, w, r = [], u = function () {
                        h = ['<fill colors="' + r.join(",") + '" opacity="', o, '" o:opacity2="', q, '" type="', i, '" ', s, 'focus="100%" method="any" />'];
                        T(e.prepVML(h), null, null, b)
                    };
                p = a[0];
                w = a[a.length - 1];
                p[0] > 0 && a.unshift([0, p[1]]);
                w[0] < 1 && a.push([1, w[1]]);
                n(a, function (a, b) {
                    g.test(a[1]) ? (f = ua(a[1]), k = f.get("rgb"), l = f.get("a")) : (k = a[1], l = 1);
                    r.push(a[0] * 100 + "% " + k);
                    b ? (o = l, H = k) : (q = l, t = k)
                });
                if (c === "fill")if (i === "gradient")c = m.x1 || m[0] || 0, a = m.y1 || m[1] || 0, p = m.x2 || m[2] || 0, m = m.y2 || m[3] || 0, s = 'angle="' +
                    (90 - P.atan((m - a) / (p - c)) * 180 / Ba) + '"', u(); else {
                    var j = m.r, x = j * 2, Z = j * 2, y = m.cx, B = m.cy, v = b.radialReference, ja, j = function () {
                        v && (ja = d.getBBox(), y += (v[0] - ja.x) / ja.width - 0.5, B += (v[1] - ja.y) / ja.height - 0.5, x *= v[2] / ja.width, Z *= v[2] / ja.height);
                        s = 'src="' + G.global.VMLRadialGradientURL + '" size="' + x + "," + Z + '" origin="0.5,0.5" position="' + y + "," + B + '" color2="' + t + '" ';
                        u()
                    };
                    d.added ? j() : F(d, "add", j);
                    j = H
                } else j = k
            } else if (g.test(a) && b.tagName !== "IMG")f = ua(a), h = ["<", c, ' opacity="', f.get("a"), '"/>'], T(this.prepVML(h), null, null,
                b), j = f.get("rgb"); else {
                j = b.getElementsByTagName(c);
                if (j.length)j[0].opacity = 1, j[0].type = "solid";
                j = a
            }
            return j
        }, prepVML: function (a) {
            var b = this.isIE8, a = a.join("");
            b ? (a = a.replace("/>", ' xmlns="urn:schemas-microsoft-com:vml" />'), a = a.indexOf('style="') === -1 ? a.replace("/>", ' style="display:inline-block;behavior:url(#default#VML);" />') : a.replace('style="', 'style="display:inline-block;behavior:url(#default#VML);')) : a = a.replace("<", "<hcv:");
            return a
        }, text: va.prototype.html, path: function (a) {
            var b = {coordsize: "10 10"};
            La(a) ? b.d = a : S(a) && r(b, a);
            return this.createElement("shape").attr(b)
        }, circle: function (a, b, c) {
            var d = this.symbol("circle");
            if (S(a))c = a.r, b = a.y, a = a.x;
            d.isCircle = !0;
            d.r = c;
            return d.attr({x: a, y: b})
        }, g: function (a) {
            var b;
            a && (b = {className: "highcharts-" + a, "class": "highcharts-" + a});
            return this.createElement(Ha).attr(b)
        }, image: function (a, b, c, d, e) {
            var f = this.createElement("img").attr({src: a});
            arguments.length > 1 && f.attr({x: b, y: c, width: d, height: e});
            return f
        }, rect: function (a, b, c, d, e, f) {
            var g = this.symbol("rect");
            g.r =
                S(a) ? a.r : e;
            return g.attr(S(a) ? a : g.crisp(f, a, b, t(c, 0), t(d, 0)))
        }, invertChild: function (a, b) {
            var c = b.style;
            D(a, {flip: "x", left: z(c.width) - 1, top: z(c.height) - 1, rotation: -90})
        }, symbols: {arc: function (a, b, c, d, e) {
            var f = e.start, g = e.end, h = e.r || c || d, c = e.innerR, d = U(f), i = $(f), j = U(g), k = $(g);
            if (g - f === 0)return["x"];
            f = ["wa", a - h, b - h, a + h, b + h, a + h * d, b + h * i, a + h * j, b + h * k];
            e.open && !c && f.push("e", "M", a, b);
            f.push("at", a - c, b - c, a + c, b + c, a + c * j, b + c * k, a + c * d, b + c * i, "x", "e");
            f.isArc = !0;
            return f
        }, circle: function (a, b, c, d, e) {
            e && (c = d = 2 * e.r);
            e && e.isCircle && (a -= c / 2, b -= d / 2);
            return["wa", a, b, a + c, b + d, a + c, b + d / 2, a + c, b + d / 2, "e"]
        }, rect: function (a, b, c, d, e) {
            var f = a + c, g = b + d, h;
            !s(e) || !e.r ? f = va.prototype.symbols.square.apply(0, arguments) : (h = I(e.r, c, d), f = ["M", a + h, b, "L", f - h, b, "wa", f - 2 * h, b, f, b + 2 * h, f - h, b, f, b + h, "L", f, g - h, "wa", f - 2 * h, g - 2 * h, f, g, f, g - h, f - h, g, "L", a + h, g, "wa", a, g - 2 * h, a + 2 * h, g, a + h, g, a, g - h, "L", a, b + h, "wa", a, b, a + 2 * h, b + 2 * h, a, b + h, a + h, b, "x", "e"]);
            return f
        }}};
        Highcharts.VMLRenderer = R = function () {
            this.init.apply(this, arguments)
        };
        R.prototype = x(va.prototype,
            xb);
        Xa = R
    }
    va.prototype.measureSpanWidth = function (a, b) {
        var c = v.createElement("span"), d;
        d = v.createTextNode(a);
        c.appendChild(d);
        D(c, b);
        this.box.appendChild(c);
        d = c.offsetWidth;
        Oa(c);
        return d
    };
    var Mb;
    if (ba)Highcharts.CanVGRenderer = R = function () {
        Da = "http://www.w3.org/1999/xhtml"
    }, R.prototype.symbols = {}, Mb = function () {
        function a() {
            var a = b.length, d;
            for (d = 0; d < a; d++)b[d]();
            b = []
        }

        var b = [];
        return{push: function (c, d) {
            b.length === 0 && Pb(d, a);
            b.push(c)
        }}
    }(), Xa = R;
    Ra.prototype = {addLabel: function () {
        var a = this.axis, b = a.options,
            c = a.chart, d = a.horiz, e = a.categories, f = a.names, g = this.pos, h = b.labels, i = a.tickPositions, d = d && e && !h.step && !h.staggerLines && !h.rotation && c.plotWidth / i.length || !d && (c.margin[3] || c.chartWidth * 0.33), j = g === i[0], k = g === i[i.length - 1], l, f = e ? o(e[g], f[g], g) : g, e = this.label, m = i.info;
        a.isDatetimeAxis && m && (l = b.dateTimeLabelFormats[m.higherRanks[g] || m.unitName]);
        this.isFirst = j;
        this.isLast = k;
        b = a.labelFormatter.call({axis: a, chart: c, isFirst: j, isLast: k, dateTimeLabelFormat: l, value: a.isLog ? ha(ea(f)) : f});
        g = d && {width: t(1, w(d -
            2 * (h.padding || 10))) + "px"};
        g = r(g, h.style);
        if (s(e))e && e.attr({text: b}).css(g); else {
            l = {align: a.labelAlign};
            if (xa(h.rotation))l.rotation = h.rotation;
            if (d && h.ellipsis)l._clipHeight = a.len / i.length;
            this.label = s(b) && h.enabled ? c.renderer.text(b, 0, 0, h.useHTML).attr(l).css(g).add(a.labelGroup) : null
        }
    }, getLabelSize: function () {
        var a = this.label, b = this.axis;
        return a ? a.getBBox()[b.horiz ? "height" : "width"] : 0
    }, getLabelSides: function () {
        var a = this.label.getBBox(), b = this.axis, c = b.horiz, d = b.options.labels, a = c ? a.width : a.height,
            b = c ? a * {left: 0, center: 0.5, right: 1}[b.labelAlign] - d.x : a;
        return[-b, a - b]
    }, handleOverflow: function (a, b) {
        var B;
        var c = !0, d = this.axis, e = this.isFirst, f = this.isLast, g = d.horiz ? b.x : b.y, h = d.reversed, i = d.tickPositions, j = this.getLabelSides(), k = j[0], j = j[1], l = d.pos, m = l + d.len, p = this.label.line || 0, q = d.labelEdge, o = d.justifyLabels && (e || f);
        q[p] === u || g + k > q[p] ? q[p] = g + j : o || (c = !1);
        if (o)B = (d = d.ticks[i[a + (e ? 1 : -1)]]) && d.label.xy && d.label.xy.x + d.getLabelSides()[e ? 0 : 1], i = B, e && !h || f && h ? g + k < l && (g = l - k, d && g + j > i && (c = !1)) : g + j > m && (g =
            m - j, d && g + k < i && (c = !1)), b.x = g;
        return c
    }, getPosition: function (a, b, c, d) {
        var e = this.axis, f = e.chart, g = d && f.oldChartHeight || f.chartHeight;
        return{x: a ? e.translate(b + c, null, null, d) + e.transB : e.left + e.offset + (e.opposite ? (d && f.oldChartWidth || f.chartWidth) - e.right - e.left : 0), y: a ? g - e.bottom + e.offset - (e.opposite ? e.height : 0) : g - e.translate(b + c, null, null, d) - e.transB}
    }, getLabelPosition: function (a, b, c, d, e, f, g, h) {
        var i = this.axis, j = i.transA, k = i.reversed, l = i.staggerLines, m = i.chart.renderer.fontMetrics(e.style.fontSize).b,
            p = e.rotation, a = a + e.x - (f && d ? f * j * (k ? -1 : 1) : 0), b = b + e.y - (f && !d ? f * j * (k ? 1 : -1) : 0);
        p && i.side === 2 && (b -= m - m * U(p * Ca));
        !s(e.y) && !p && (b += m - c.getBBox().height / 2);
        if (l)c.line = g / (h || 1) % l, b += c.line * (i.labelOffset / l);
        return{x: a, y: b}
    }, getMarkPath: function (a, b, c, d, e, f) {
        return f.crispLine(["M", a, b, "L", a + (e ? 0 : -c), b + (e ? c : 0)], d)
    }, render: function (a, b, c) {
        var d = this.axis, e = d.options, f = d.chart.renderer, g = d.horiz, h = this.type, i = this.label, j = this.pos, k = e.labels, l = this.gridLine, m = h ? h + "Grid" : "grid", p = h ? h + "Tick" : "tick", q = e[m + "LineWidth"],
            n = e[m + "LineColor"], H = e[m + "LineDashStyle"], t = e[p + "Length"], m = e[p + "Width"] || 0, s = e[p + "Color"], w = e[p + "Position"], p = this.mark, r = k.step, ia = !0, x = d.tickmarkOffset, v = this.getPosition(g, j, x, b), y = v.x, v = v.y, B = g && y === d.pos + d.len || !g && v === d.pos ? -1 : 1;
        this.isActive = !0;
        if (q) {
            j = d.getPlotLinePath(j + x, q * B, b, !0);
            if (l === u) {
                l = {stroke: n, "stroke-width": q};
                if (H)l.dashstyle = H;
                if (!h)l.zIndex = 1;
                if (b)l.opacity = 0;
                this.gridLine = l = q ? f.path(j).attr(l).add(d.gridGroup) : null
            }
            if (!b && l && j)l[this.isNew ? "attr" : "animate"]({d: j, opacity: c})
        }
        if (m &&
            t)w === "inside" && (t = -t), d.opposite && (t = -t), h = this.getMarkPath(y, v, t, m * B, g, f), p ? p.animate({d: h, opacity: c}) : this.mark = f.path(h).attr({stroke: s, "stroke-width": m, opacity: c}).add(d.axisGroup);
        if (i && !isNaN(y))i.xy = v = this.getLabelPosition(y, v, i, g, k, x, a, r), this.isFirst && !this.isLast && !o(e.showFirstLabel, 1) || this.isLast && !this.isFirst && !o(e.showLastLabel, 1) ? ia = !1 : !d.isRadial && !k.step && !k.rotation && !b && c !== 0 && (ia = this.handleOverflow(a, v)), r && a % r && (ia = !1), ia && !isNaN(v.y) ? (v.opacity = c, i[this.isNew ? "attr" : "animate"](v),
            this.isNew = !1) : i.attr("y", -9999)
    }, destroy: function () {
        Na(this, this.axis)
    }};
    var yb = function (a, b) {
        this.axis = a;
        if (b)this.options = b, this.id = b.id
    };
    yb.prototype = {render: function () {
        var a = this, b = a.axis, c = b.horiz, d = (b.pointRange || 0) / 2, e = a.options, f = e.label, g = a.label, h = e.width, i = e.to, j = e.from, k = s(j) && s(i), l = e.value, m = e.dashStyle, p = a.svgElem, q = [], n, H = e.color, w = e.zIndex, r = e.events, u = b.chart.renderer;
        b.isLog && (j = ya(j), i = ya(i), l = ya(l));
        if (h) {
            if (q = b.getPlotLinePath(l, h), d = {stroke: H, "stroke-width": h}, m)d.dashstyle =
                m
        } else if (k) {
            if (j = t(j, b.min - d), i = I(i, b.max + d), q = b.getPlotBandPath(j, i, e), d = {fill: H}, e.borderWidth)d.stroke = e.borderColor, d["stroke-width"] = e.borderWidth
        } else return;
        if (s(w))d.zIndex = w;
        if (p)if (q)p.animate({d: q}, null, p.onGetPath); else {
            if (p.hide(), p.onGetPath = function () {
                p.show()
            }, g)a.label = g = g.destroy()
        } else if (q && q.length && (a.svgElem = p = u.path(q).attr(d).add(), r))for (n in e = function (b) {
            p.on(b, function (c) {
                r[b].apply(a, [c])
            })
        }, r)e(n);
        if (f && s(f.text) && q && q.length && b.width > 0 && b.height > 0) {
            f = x({align: c && k &&
                "center", x: c ? !k && 4 : 10, verticalAlign: !c && k && "middle", y: c ? k ? 16 : 10 : k ? 6 : -4, rotation: c && !k && 90}, f);
            if (!g)a.label = g = u.text(f.text, 0, 0, f.useHTML).attr({align: f.textAlign || f.align, rotation: f.rotation, zIndex: w}).css(f.style).add();
            b = [q[1], q[4], o(q[6], q[1])];
            q = [q[2], q[5], o(q[7], q[2])];
            c = Ma(b);
            k = Ma(q);
            g.align(f, !1, {x: c, y: k, width: Aa(b) - c, height: Aa(q) - k});
            g.show()
        } else g && g.hide();
        return a
    }, destroy: function () {
        fa(this.axis.plotLinesAndBands, this);
        delete this.axis;
        Na(this)
    }};
    ra.prototype = {defaultOptions: {dateTimeLabelFormats: {millisecond: "%H:%M:%S.%L",
        second: "%H:%M:%S", minute: "%H:%M", hour: "%H:%M", day: "%e. %b", week: "%e. %b", month: "%b '%y", year: "%Y"}, endOnTick: !1, gridLineColor: "#C0C0C0", labels: J, lineColor: "#C0D0E0", lineWidth: 1, minPadding: 0.01, maxPadding: 0.01, minorGridLineColor: "#E0E0E0", minorGridLineWidth: 1, minorTickColor: "#A0A0A0", minorTickLength: 2, minorTickPosition: "outside", startOfWeek: 1, startOnTick: !1, tickColor: "#C0D0E0", tickLength: 5, tickmarkPlacement: "between", tickPixelInterval: 100, tickPosition: "outside", tickWidth: 1, title: {align: "middle", style: {color: "#4d759e",
        fontWeight: "bold"}}, type: "linear"}, defaultYAxisOptions: {endOnTick: !0, gridLineWidth: 1, tickPixelInterval: 72, showLastLabel: !0, labels: {x: -8, y: 3}, lineWidth: 0, maxPadding: 0.05, minPadding: 0.05, startOnTick: !0, tickWidth: 0, title: {rotation: 270, text: "Values"}, stackLabels: {enabled: !1, formatter: function () {
        return Ea(this.total, -1)
    }, style: J.style}}, defaultLeftAxisOptions: {labels: {x: -8, y: null}, title: {rotation: 270}}, defaultRightAxisOptions: {labels: {x: 8, y: null}, title: {rotation: 90}}, defaultBottomAxisOptions: {labels: {x: 0,
        y: 14}, title: {rotation: 0}}, defaultTopAxisOptions: {labels: {x: 0, y: -5}, title: {rotation: 0}}, init: function (a, b) {
        var c = b.isX;
        this.horiz = a.inverted ? !c : c;
        this.coll = (this.isXAxis = c) ? "xAxis" : "yAxis";
        this.opposite = b.opposite;
        this.side = b.side || (this.horiz ? this.opposite ? 0 : 2 : this.opposite ? 1 : 3);
        this.setOptions(b);
        var d = this.options, e = d.type;
        this.labelFormatter = d.labels.formatter || this.defaultLabelFormatter;
        this.userOptions = b;
        this.minPixelPadding = 0;
        this.chart = a;
        this.reversed = d.reversed;
        this.zoomEnabled = d.zoomEnabled !== !1;
        this.categories = d.categories || e === "category";
        this.names = [];
        this.isLog = e === "logarithmic";
        this.isDatetimeAxis = e === "datetime";
        this.isLinked = s(d.linkedTo);
        this.tickmarkOffset = this.categories && d.tickmarkPlacement === "between" ? 0.5 : 0;
        this.ticks = {};
        this.labelEdge = [];
        this.minorTicks = {};
        this.plotLinesAndBands = [];
        this.alternateBands = {};
        this.len = 0;
        this.minRange = this.userMinRange = d.minRange || d.maxZoom;
        this.range = d.range;
        this.offset = d.offset || 0;
        this.stacks = {};
        this.oldStacks = {};
        this.stackExtremes = {};
        this.min =
            this.max = null;
        this.crosshair = o(d.crosshair, ka(a.options.tooltip.crosshairs)[c ? 0 : 1], !1);
        var f, d = this.options.events;
        ta(this, a.axes) === -1 && (a.axes.push(this), a[this.coll].push(this));
        this.series = this.series || [];
        if (a.inverted && c && this.reversed === u)this.reversed = !0;
        this.removePlotLine = this.removePlotBand = this.removePlotBandOrLine;
        for (f in d)F(this, f, d[f]);
        if (this.isLog)this.val2lin = ya, this.lin2val = ea
    }, setOptions: function (a) {
        this.options = x(this.defaultOptions, this.isXAxis ? {} : this.defaultYAxisOptions, [this.defaultTopAxisOptions,
            this.defaultRightAxisOptions, this.defaultBottomAxisOptions, this.defaultLeftAxisOptions][this.side], x(G[this.coll], a))
    }, defaultLabelFormatter: function () {
        var a = this.axis, b = this.value, c = a.categories, d = this.dateTimeLabelFormat, e = G.lang.numericSymbols, f = e && e.length, g, h = a.options.labels.format, a = a.isLog ? b : a.tickInterval;
        if (h)g = Ga(h, this); else if (c)g = b; else if (d)g = $a(d, b); else if (f && a >= 1E3)for (; f-- && g === u;)c = Math.pow(1E3, f + 1), a >= c && e[f] !== null && (g = Ea(b / c, -1) + e[f]);
        g === u && (g = b >= 1E4 ? Ea(b, 0) : Ea(b, -1, u, ""));
        return g
    }, getSeriesExtremes: function () {
        var a = this, b = a.chart;
        a.hasVisibleSeries = !1;
        a.dataMin = a.dataMax = null;
        a.stackExtremes = {};
        a.buildStacks();
        n(a.series, function (c) {
            if (c.visible || !b.options.chart.ignoreHiddenSeries) {
                var d;
                d = c.options.threshold;
                var e;
                a.hasVisibleSeries = !0;
                a.isLog && d <= 0 && (d = null);
                if (a.isXAxis) {
                    if (d = c.xData, d.length)a.dataMin = I(o(a.dataMin, d[0]), Ma(d)), a.dataMax = t(o(a.dataMax, d[0]), Aa(d))
                } else {
                    c.getExtremes();
                    e = c.dataMax;
                    c = c.dataMin;
                    if (s(c) && s(e))a.dataMin = I(o(a.dataMin, c), c), a.dataMax =
                        t(o(a.dataMax, e), e);
                    if (s(d))if (a.dataMin >= d)a.dataMin = d, a.ignoreMinPadding = !0; else if (a.dataMax < d)a.dataMax = d, a.ignoreMaxPadding = !0
                }
            }
        })
    }, translate: function (a, b, c, d, e, f) {
        var g = this.len, h = 1, i = 0, j = d ? this.oldTransA : this.transA, d = d ? this.oldMin : this.min, k = this.minPixelPadding, e = (this.options.ordinal || this.isLog && e) && this.lin2val;
        if (!j)j = this.transA;
        c && (h *= -1, i = g);
        this.reversed && (h *= -1, i -= h * g);
        b ? (a = a * h + i, a -= k, a = a / j + d, e && (a = this.lin2val(a))) : (e && (a = this.val2lin(a)), f === "between" && (f = 0.5), a = h * (a - d) * j + i + h *
            k + (xa(f) ? j * f * this.pointRange : 0));
        return a
    }, toPixels: function (a, b) {
        return this.translate(a, !1, !this.horiz, null, !0) + (b ? 0 : this.pos)
    }, toValue: function (a, b) {
        return this.translate(a - (b ? 0 : this.pos), !0, !this.horiz, null, !0)
    }, getPlotLinePath: function (a, b, c, d, e) {
        var f = this.chart, g = this.left, h = this.top, i, j, k = c && f.oldChartHeight || f.chartHeight, l = c && f.oldChartWidth || f.chartWidth, m;
        i = this.transB;
        e = o(e, this.translate(a, null, null, c));
        a = c = w(e + i);
        i = j = w(k - e - i);
        if (isNaN(e))m = !0; else if (this.horiz) {
            if (i = h, j = k - this.bottom,
                a < g || a > g + this.width)m = !0
        } else if (a = g, c = l - this.right, i < h || i > h + this.height)m = !0;
        return m && !d ? null : f.renderer.crispLine(["M", a, i, "L", c, j], b || 1)
    }, getLinearTickPositions: function (a, b, c) {
        for (var d, b = ha(N(b / a) * a), c = ha(Ia(c / a) * a), e = []; b <= c;) {
            e.push(b);
            b = ha(b + a);
            if (b === d)break;
            d = b
        }
        return e
    }, getMinorTickPositions: function () {
        var a = this.options, b = this.tickPositions, c = this.minorTickInterval, d = [], e;
        if (this.isLog) {
            e = b.length;
            for (a = 1; a < e; a++)d = d.concat(this.getLogTickPositions(c, b[a - 1], b[a], !0))
        } else if (this.isDatetimeAxis &&
            a.minorTickInterval === "auto")d = d.concat(this.getTimeTicks(this.normalizeTimeTickInterval(c), this.min, this.max, a.startOfWeek)), d[0] < this.min && d.shift(); else for (b = this.min + (b[0] - this.min) % c; b <= this.max; b += c)d.push(b);
        return d
    }, adjustForMinRange: function () {
        var a = this.options, b = this.min, c = this.max, d, e = this.dataMax - this.dataMin >= this.minRange, f, g, h, i, j;
        if (this.isXAxis && this.minRange === u && !this.isLog)s(a.min) || s(a.max) ? this.minRange = null : (n(this.series, function (a) {
            i = a.xData;
            for (g = j = a.xIncrement ? 1 : i.length -
                1; g > 0; g--)if (h = i[g] - i[g - 1], f === u || h < f)f = h
        }), this.minRange = I(f * 5, this.dataMax - this.dataMin));
        if (c - b < this.minRange) {
            var k = this.minRange;
            d = (k - c + b) / 2;
            d = [b - d, o(a.min, b - d)];
            if (e)d[2] = this.dataMin;
            b = Aa(d);
            c = [b + k, o(a.max, b + k)];
            if (e)c[2] = this.dataMax;
            c = Ma(c);
            c - b < k && (d[0] = c - k, d[1] = o(a.min, c - k), b = Aa(d))
        }
        this.min = b;
        this.max = c
    }, setAxisTranslation: function (a) {
        var b = this.max - this.min, c = 0, d, e = 0, f = 0, g = this.linkedParent, h = !!this.categories, i = this.transA;
        if (this.isXAxis || h)g ? (e = g.minPointOffset, f = g.pointRangePadding) :
            n(this.series, function (a) {
                var g = t(a.pointRange, +h), i = a.options.pointPlacement, m = a.closestPointRange;
                g > b && (g = 0);
                c = t(c, g);
                e = t(e, da(i) ? 0 : g / 2);
                f = t(f, i === "on" ? 0 : g);
                !a.noSharedTooltip && s(m) && (d = s(d) ? I(d, m) : m)
            }), g = this.ordinalSlope && d ? this.ordinalSlope / d : 1, this.minPointOffset = e *= g, this.pointRangePadding = f *= g, this.pointRange = I(c, b), this.closestPointRange = d;
        if (a)this.oldTransA = i;
        this.translationSlope = this.transA = i = this.len / (b + f || 1);
        this.transB = this.horiz ? this.left : this.bottom;
        this.minPixelPadding = i * e
    }, setTickPositions: function (a) {
        var b =
            this, c = b.chart, d = b.options, e = b.isLog, f = b.isDatetimeAxis, g = b.isXAxis, h = b.isLinked, i = b.options.tickPositioner, j = d.maxPadding, k = d.minPadding, l = d.tickInterval, m = d.minTickInterval, p = d.tickPixelInterval, q, na = b.categories;
        h ? (b.linkedParent = c[b.coll][d.linkedTo], c = b.linkedParent.getExtremes(), b.min = o(c.min, c.dataMin), b.max = o(c.max, c.dataMax), d.type !== b.linkedParent.options.type && la(11, 1)) : (b.min = o(b.userMin, d.min, b.dataMin), b.max = o(b.userMax, d.max, b.dataMax));
        if (e)!a && I(b.min, o(b.dataMin, b.min)) <= 0 && la(10,
            1), b.min = ha(ya(b.min)), b.max = ha(ya(b.max));
        if (b.range && s(b.max))b.userMin = b.min = t(b.min, b.max - b.range), b.userMax = b.max, b.range = null;
        b.beforePadding && b.beforePadding();
        b.adjustForMinRange();
        if (!na && !b.usePercentage && !h && s(b.min) && s(b.max) && (c = b.max - b.min)) {
            if (!s(d.min) && !s(b.userMin) && k && (b.dataMin < 0 || !b.ignoreMinPadding))b.min -= c * k;
            if (!s(d.max) && !s(b.userMax) && j && (b.dataMax > 0 || !b.ignoreMaxPadding))b.max += c * j
        }
        b.min === b.max || b.min === void 0 || b.max === void 0 ? b.tickInterval = 1 : h && !l && p === b.linkedParent.options.tickPixelInterval ?
            b.tickInterval = b.linkedParent.tickInterval : (b.tickInterval = o(l, na ? 1 : (b.max - b.min) * p / t(b.len, p)), !s(l) && b.len < p && !this.isRadial && !na && d.startOnTick && d.endOnTick && (q = !0, b.tickInterval /= 4));
        g && !a && n(b.series, function (a) {
            a.processData(b.min !== b.oldMin || b.max !== b.oldMax)
        });
        b.setAxisTranslation(!0);
        b.beforeSetTickPositions && b.beforeSetTickPositions();
        if (b.postProcessTickInterval)b.tickInterval = b.postProcessTickInterval(b.tickInterval);
        if (b.pointRange)b.tickInterval = t(b.pointRange, b.tickInterval);
        if (!l &&
            b.tickInterval < m)b.tickInterval = m;
        if (!f && !e && !l)b.tickInterval = mb(b.tickInterval, null, lb(b.tickInterval), d);
        b.minorTickInterval = d.minorTickInterval === "auto" && b.tickInterval ? b.tickInterval / 5 : d.minorTickInterval;
        b.tickPositions = a = d.tickPositions ? [].concat(d.tickPositions) : i && i.apply(b, [b.min, b.max]);
        if (!a)!b.ordinalPositions && (b.max - b.min) / b.tickInterval > t(2 * b.len, 200) && la(19, !0), a = f ? b.getTimeTicks(b.normalizeTimeTickInterval(b.tickInterval, d.units), b.min, b.max, d.startOfWeek, b.ordinalPositions, b.closestPointRange,
            !0) : e ? b.getLogTickPositions(b.tickInterval, b.min, b.max) : b.getLinearTickPositions(b.tickInterval, b.min, b.max), q && a.splice(1, a.length - 2), b.tickPositions = a;
        if (!h)e = a[0], f = a[a.length - 1], h = b.minPointOffset || 0, d.startOnTick ? b.min = e : b.min - h > e && a.shift(), d.endOnTick ? b.max = f : b.max + h < f && a.pop(), a.length === 1 && (b.min -= 0.001, b.max += 0.001)
    }, setMaxTicks: function () {
        var a = this.chart, b = a.maxTicks || {}, c = this.tickPositions, d = this._maxTicksKey = [this.coll, this.pos, this.len].join("-");
        if (!this.isLinked && !this.isDatetimeAxis &&
            c && c.length > (b[d] || 0) && this.options.alignTicks !== !1)b[d] = c.length;
        a.maxTicks = b
    }, adjustTickAmount: function () {
        var a = this._maxTicksKey, b = this.tickPositions, c = this.chart.maxTicks;
        if (c && c[a] && !this.isDatetimeAxis && !this.categories && !this.isLinked && this.options.alignTicks !== !1 && this.min !== u) {
            var d = this.tickAmount, e = b.length;
            this.tickAmount = a = c[a];
            if (e < a) {
                for (; b.length < a;)b.push(ha(b[b.length - 1] + this.tickInterval));
                this.transA *= (e - 1) / (a - 1);
                this.max = b[b.length - 1]
            }
            if (s(d) && a !== d)this.isDirty = !0
        }
    }, setScale: function () {
        var a =
            this.stacks, b, c, d, e;
        this.oldMin = this.min;
        this.oldMax = this.max;
        this.oldAxisLength = this.len;
        this.setAxisSize();
        e = this.len !== this.oldAxisLength;
        n(this.series, function (a) {
            if (a.isDirtyData || a.isDirty || a.xAxis.isDirty)d = !0
        });
        if (e || d || this.isLinked || this.forceRedraw || this.userMin !== this.oldUserMin || this.userMax !== this.oldUserMax) {
            if (!this.isXAxis)for (b in a)for (c in a[b])a[b][c].total = null, a[b][c].cum = 0;
            this.forceRedraw = !1;
            this.getSeriesExtremes();
            this.setTickPositions();
            this.oldUserMin = this.userMin;
            this.oldUserMax =
                this.userMax;
            if (!this.isDirty)this.isDirty = e || this.min !== this.oldMin || this.max !== this.oldMax
        } else if (!this.isXAxis) {
            if (this.oldStacks)a = this.stacks = this.oldStacks;
            for (b in a)for (c in a[b])a[b][c].cum = a[b][c].total
        }
        this.setMaxTicks()
    }, setExtremes: function (a, b, c, d, e) {
        var f = this, g = f.chart, c = o(c, !0), e = r(e, {min: a, max: b});
        A(f, "setExtremes", e, function () {
            f.userMin = a;
            f.userMax = b;
            f.eventArgs = e;
            f.isDirtyExtremes = !0;
            c && g.redraw(d)
        })
    }, zoom: function (a, b) {
        this.allowZoomOutside || (s(this.dataMin) && a <= this.dataMin &&
            (a = u), s(this.dataMax) && b >= this.dataMax && (b = u));
        this.displayBtn = a !== u || b !== u;
        this.setExtremes(a, b, !1, u, {trigger: "zoom"});
        return!0
    }, setAxisSize: function () {
        var a = this.chart, b = this.options, c = b.offsetLeft || 0, d = b.offsetRight || 0, e = this.horiz, f, g;
        this.left = g = o(b.left, a.plotLeft + c);
        this.top = f = o(b.top, a.plotTop);
        this.width = c = o(b.width, a.plotWidth - c + d);
        this.height = b = o(b.height, a.plotHeight);
        this.bottom = a.chartHeight - b - f;
        this.right = a.chartWidth - c - g;
        this.len = t(e ? c : b, 0);
        this.pos = e ? g : f
    }, getExtremes: function () {
        var a =
            this.isLog;
        return{min: a ? ha(ea(this.min)) : this.min, max: a ? ha(ea(this.max)) : this.max, dataMin: this.dataMin, dataMax: this.dataMax, userMin: this.userMin, userMax: this.userMax}
    }, getThreshold: function (a) {
        var b = this.isLog, c = b ? ea(this.min) : this.min, b = b ? ea(this.max) : this.max;
        c > a || a === null ? a = c : b < a && (a = b);
        return this.translate(a, 0, 1, 0, 1)
    }, autoLabelAlign: function (a) {
        a = (o(a, 0) - this.side * 90 + 720) % 360;
        return a > 15 && a < 165 ? "right" : a > 195 && a < 345 ? "left" : "center"
    }, getOffset: function () {
        var a = this, b = a.chart, c = b.renderer, d = a.options,
            e = a.tickPositions, f = a.ticks, g = a.horiz, h = a.side, i = b.inverted ? [1, 0, 3, 2][h] : h, j, k = 0, l, m = 0, p = d.title, q = d.labels, na = 0, H = b.axisOffset, w = b.clipOffset, r = [-1, 1, 1, -1][h], v, x = 1, y = o(q.maxStaggerLines, 5), z, Z, K, B;
        a.hasData = j = a.hasVisibleSeries || s(a.min) && s(a.max) && !!e;
        a.showAxis = b = j || o(d.showEmpty, !0);
        a.staggerLines = a.horiz && q.staggerLines;
        if (!a.axisGroup)a.gridGroup = c.g("grid").attr({zIndex: d.gridZIndex || 1}).add(), a.axisGroup = c.g("axis").attr({zIndex: d.zIndex || 2}).add(), a.labelGroup = c.g("axis-labels").attr({zIndex: q.zIndex ||
            7}).add();
        if (j || a.isLinked) {
            a.labelAlign = o(q.align || a.autoLabelAlign(q.rotation));
            n(e, function (b) {
                f[b] ? f[b].addLabel() : f[b] = new Ra(a, b)
            });
            if (a.horiz && !a.staggerLines && y && !q.rotation) {
                for (v = a.reversed ? [].concat(e).reverse() : e; x < y;) {
                    j = [];
                    z = !1;
                    for (q = 0; q < v.length; q++)Z = v[q], K = (K = f[Z].label && f[Z].label.getBBox()) ? K.width : 0, B = q % x, K && (Z = a.translate(Z), j[B] !== u && Z < j[B] && (z = !0), j[B] = Z + K);
                    if (z)x++; else break
                }
                if (x > 1)a.staggerLines = x
            }
            n(e, function (b) {
                if (h === 0 || h === 2 || {1: "left", 3: "right"}[h] === a.labelAlign)na =
                    t(f[b].getLabelSize(), na)
            });
            if (a.staggerLines)na *= a.staggerLines, a.labelOffset = na
        } else for (v in f)f[v].destroy(), delete f[v];
        if (p && p.text && p.enabled !== !1) {
            if (!a.axisTitle)a.axisTitle = c.text(p.text, 0, 0, p.useHTML).attr({zIndex: 7, rotation: p.rotation || 0, align: p.textAlign || {low: "left", middle: "center", high: "right"}[p.align]}).css(p.style).add(a.axisGroup), a.axisTitle.isNew = !0;
            if (b)k = a.axisTitle.getBBox()[g ? "height" : "width"], m = o(p.margin, g ? 5 : 10), l = p.offset;
            a.axisTitle[b ? "show" : "hide"]()
        }
        a.offset = r * o(d.offset,
            H[h]);
        a.axisTitleMargin = o(l, na + m + (h !== 2 && na && r * d.labels[g ? "y" : "x"]));
        H[h] = t(H[h], a.axisTitleMargin + k + r * a.offset);
        w[i] = t(w[i], N(d.lineWidth / 2) * 2)
    }, getLinePath: function (a) {
        var b = this.chart, c = this.opposite, d = this.offset, e = this.horiz, f = this.left + (c ? this.width : 0) + d, d = b.chartHeight - this.bottom - (c ? this.height : 0) + d;
        c && (a *= -1);
        return b.renderer.crispLine(["M", e ? this.left : f, e ? d : this.top, "L", e ? b.chartWidth - this.right : f, e ? d : b.chartHeight - this.bottom], a)
    }, getTitlePosition: function () {
        var a = this.horiz, b = this.left,
            c = this.top, d = this.len, e = this.options.title, f = a ? b : c, g = this.opposite, h = this.offset, i = z(e.style.fontSize || 12), d = {low: f + (a ? 0 : d), middle: f + d / 2, high: f + (a ? d : 0)}[e.align], b = (a ? c + this.height : b) + (a ? 1 : -1) * (g ? -1 : 1) * this.axisTitleMargin + (this.side === 2 ? i : 0);
        return{x: a ? d : b + (g ? this.width : 0) + h + (e.x || 0), y: a ? b - (g ? this.height : 0) + h : d + (e.y || 0)}
    }, render: function () {
        var a = this, b = a.horiz, c = a.reversed, d = a.chart, e = d.renderer, f = a.options, g = a.isLog, h = a.isLinked, i = a.tickPositions, j, k = a.axisTitle, l = a.stacks, m = a.ticks, p = a.minorTicks,
            q = a.alternateBands, o = f.stackLabels, H = f.alternateGridColor, t = a.tickmarkOffset, w = f.lineWidth, r = d.hasRendered && s(a.oldMin) && !isNaN(a.oldMin), v = a.hasData, x = a.showAxis, y, z = a.justifyLabels = !a.staggerLines && b && f.labels.overflow === "justify", K;
        a.labelEdge.length = 0;
        n([m, p, q], function (a) {
            for (var b in a)a[b].isActive = !1
        });
        if (v || h)if (a.minorTickInterval && !a.categories && n(a.getMinorTickPositions(), function (b) {
            p[b] || (p[b] = new Ra(a, b, "minor"));
            r && p[b].isNew && p[b].render(null, !0);
            p[b].render(null, !1, 1)
        }), i.length &&
            (j = i.slice(), (b && c || !b && !c) && j.reverse(), z && (j = j.slice(1).concat([j[0]])), n(j, function (b, c) {
                z && (c = c === j.length - 1 ? 0 : c + 1);
                if (!h || b >= a.min && b <= a.max)m[b] || (m[b] = new Ra(a, b)), r && m[b].isNew && m[b].render(c, !0, 0.1), m[b].render(c, !1, 1)
            }), t && a.min === 0 && (m[-1] || (m[-1] = new Ra(a, -1, null, !0)), m[-1].render(-1))), H && n(i, function (b, c) {
            if (c % 2 === 0 && b < a.max)q[b] || (q[b] = new yb(a)), y = b + t, K = i[c + 1] !== u ? i[c + 1] + t : a.max, q[b].options = {from: g ? ea(y) : y, to: g ? ea(K) : K, color: H}, q[b].render(), q[b].isActive = !0
        }), !a._addedPlotLB)n((f.plotLines ||
            []).concat(f.plotBands || []), function (b) {
            a.addPlotBandOrLine(b)
        }), a._addedPlotLB = !0;
        n([m, p, q], function (a) {
            var b, c, e = [], f = pa ? pa.duration || 500 : 0, g = function () {
                for (c = e.length; c--;)a[e[c]] && !a[e[c]].isActive && (a[e[c]].destroy(), delete a[e[c]])
            };
            for (b in a)if (!a[b].isActive)a[b].render(b, !1, 0), a[b].isActive = !1, e.push(b);
            a === q || !d.hasRendered || !f ? g() : f && setTimeout(g, f)
        });
        if (w)b = a.getLinePath(w), a.axisLine ? a.axisLine.animate({d: b}) : a.axisLine = e.path(b).attr({stroke: f.lineColor, "stroke-width": w, zIndex: 7}).add(a.axisGroup),
            a.axisLine[x ? "show" : "hide"]();
        if (k && x)k[k.isNew ? "attr" : "animate"](a.getTitlePosition()), k.isNew = !1;
        if (o && o.enabled) {
            var B, A, f = a.stackTotalGroup;
            if (!f)a.stackTotalGroup = f = e.g("stack-labels").attr({visibility: "visible", zIndex: 6}).add();
            f.translate(d.plotLeft, d.plotTop);
            for (B in l)for (A in e = l[B], e)e[A].render(f)
        }
        a.isDirty = !1
    }, redraw: function () {
        var a = this.chart.pointer;
        a.reset && a.reset(!0);
        this.render();
        n(this.plotLinesAndBands, function (a) {
            a.render()
        });
        n(this.series, function (a) {
            a.isDirty = !0
        })
    }, buildStacks: function () {
        var a =
            this.series, b = a.length;
        if (!this.isXAxis) {
            for (; b--;)a[b].setStackedPoints();
            if (this.usePercentage)for (b = 0; b < a.length; b++)a[b].setPercentStacks()
        }
    }, destroy: function (a) {
        var b = this, c = b.stacks, d, e = b.plotLinesAndBands;
        a || X(b);
        for (d in c)Na(c[d]), c[d] = null;
        n([b.ticks, b.minorTicks, b.alternateBands], function (a) {
            Na(a)
        });
        for (a = e.length; a--;)e[a].destroy();
        n("stackTotalGroup,axisLine,axisTitle,axisGroup,cross,gridGroup,labelGroup".split(","), function (a) {
            b[a] && (b[a] = b[a].destroy())
        });
        this.cross && this.cross.destroy()
    },
        drawCrosshair: function (a, b) {
            if (this.crosshair)if ((s(b) || !o(this.crosshair.snap, !0)) === !1)this.hideCrosshair(); else {
                var c, d = this.crosshair, e = d.animation;
                o(d.snap, !0) ? s(b) && (c = this.chart.inverted != this.horiz ? b.plotX : this.len - b.plotY) : c = this.horiz ? a.chartX - this.pos : this.len - a.chartY + this.pos;
                c = this.isRadial ? this.getPlotLinePath(this.isXAxis ? b.x : o(b.stackY, b.y)) : this.getPlotLinePath(null, null, null, null, c);
                if (c === null)this.hideCrosshair(); else if (this.cross)this.cross.attr({visibility: "visible"})[e ? "animate" :
                    "attr"]({d: c}, e); else {
                    e = {"stroke-width": d.width || 1, stroke: d.color || "#C0C0C0", zIndex: d.zIndex || 2};
                    if (d.dashStyle)e.dashstyle = d.dashStyle;
                    this.cross = this.chart.renderer.path(c).attr(e).add()
                }
            }
        }, hideCrosshair: function () {
            this.cross && this.cross.hide()
        }};
    r(ra.prototype, {getPlotBandPath: function (a, b) {
        var c = this.getPlotLinePath(b), d = this.getPlotLinePath(a);
        d && c ? d.push(c[4], c[5], c[1], c[2]) : d = null;
        return d
    }, addPlotBand: function (a) {
        this.addPlotBandOrLine(a, "plotBands")
    }, addPlotLine: function (a) {
        this.addPlotBandOrLine(a,
            "plotLines")
    }, addPlotBandOrLine: function (a, b) {
        var c = (new yb(this, a)).render(), d = this.userOptions;
        c && (b && (d[b] = d[b] || [], d[b].push(a)), this.plotLinesAndBands.push(c));
        return c
    }, removePlotBandOrLine: function (a) {
        for (var b = this.plotLinesAndBands, c = this.options, d = this.userOptions, e = b.length; e--;)b[e].id === a && b[e].destroy();
        n([c.plotLines || [], d.plotLines || [], c.plotBands || [], d.plotBands || []], function (b) {
            for (e = b.length; e--;)b[e].id === a && fa(b, b[e])
        })
    }});
    ra.prototype.getLogTickPositions = function (a, b, c, d) {
        var e =
            this.options, f = this.len, g = [];
        if (!d)this._minorAutoInterval = null;
        if (a >= 0.5)a = w(a), g = this.getLinearTickPositions(a, b, c); else if (a >= 0.08)for (var f = N(b), h, i, j, k, l, e = a > 0.3 ? [1, 2, 4] : a > 0.15 ? [1, 2, 4, 6, 8] : [1, 2, 3, 4, 5, 6, 7, 8, 9]; f < c + 1 && !l; f++) {
            i = e.length;
            for (h = 0; h < i && !l; h++)j = ya(ea(f) * e[h]), j > b && (!d || k <= c) && g.push(k), k > c && (l = !0), k = j
        } else if (b = ea(b), c = ea(c), a = e[d ? "minorTickInterval" : "tickInterval"], a = o(a === "auto" ? null : a, this._minorAutoInterval, (c - b) * (e.tickPixelInterval / (d ? 5 : 1)) / ((d ? f / this.tickPositions.length : f) ||
            1)), a = mb(a, null, lb(a)), g = Sa(this.getLinearTickPositions(a, b, c), ya), !d)this._minorAutoInterval = a / 5;
        if (!d)this.tickInterval = a;
        return g
    };
    ra.prototype.getTimeTicks = function (a, b, c, d) {
        var e = [], f = {}, g = G.global.useUTC, h, i = new Date(b - Qa), j = a.unitRange, k = a.count;
        if (s(b)) {
            j >= E.second && (i.setMilliseconds(0), i.setSeconds(j >= E.minute ? 0 : k * N(i.getSeconds() / k)));
            if (j >= E.minute)i[Cb](j >= E.hour ? 0 : k * N(i[ob]() / k));
            if (j >= E.hour)i[Db](j >= E.day ? 0 : k * N(i[pb]() / k));
            if (j >= E.day)i[rb](j >= E.month ? 1 : k * N(i[Va]() / k));
            j >= E.month &&
            (i[Eb](j >= E.year ? 0 : k * N(i[cb]() / k)), h = i[db]());
            j >= E.year && (h -= h % k, i[Fb](h));
            if (j === E.week)i[rb](i[Va]() - i[qb]() + o(d, 1));
            b = 1;
            Qa && (i = new Date(i.getTime() + Qa));
            h = i[db]();
            for (var d = i.getTime(), l = i[cb](), m = i[Va](), p = g ? Qa : (864E5 + i.getTimezoneOffset() * 6E4) % 864E5; d < c;)e.push(d), j === E.year ? d = bb(h + b * k, 0) : j === E.month ? d = bb(h, l + b * k) : !g && (j === E.day || j === E.week) ? d = bb(h, l, m + b * k * (j === E.day ? 1 : 7)) : d += j * k, b++;
            e.push(d);
            n(vb(e, function (a) {
                return j <= E.hour && a % E.day === p
            }), function (a) {
                f[a] = "day"
            })
        }
        e.info = r(a, {higherRanks: f,
            totalRange: j * k});
        return e
    };
    ra.prototype.normalizeTimeTickInterval = function (a, b) {
        var c = b || [
            ["millisecond", [1, 2, 5, 10, 20, 25, 50, 100, 200, 500]],
            ["second", [1, 2, 5, 10, 15, 30]],
            ["minute", [1, 2, 5, 10, 15, 30]],
            ["hour", [1, 2, 3, 4, 6, 8, 12]],
            ["day", [1, 2]],
            ["week", [1, 2]],
            ["month", [1, 2, 3, 4, 6]],
            ["year", null]
        ], d = c[c.length - 1], e = E[d[0]], f = d[1], g;
        for (g = 0; g < c.length; g++)if (d = c[g], e = E[d[0]], f = d[1], c[g + 1] && a <= (e * f[f.length - 1] + E[c[g + 1][0]]) / 2)break;
        e === E.year && a < 5 * e && (f = [1, 2, 5]);
        c = mb(a / e, f, d[0] === "year" ? t(lb(a / e), 1) : 1);
        return{unitRange: e,
            count: c, unitName: d[0]}
    };
    Gb.prototype = {destroy: function () {
        Na(this, this.axis)
    }, render: function (a) {
        var b = this.options, c = b.format, c = c ? Ga(c, this) : b.formatter.call(this);
        this.label ? this.label.attr({text: c, visibility: "hidden"}) : this.label = this.axis.chart.renderer.text(c, 0, 0, b.useHTML).css(b.style).attr({align: this.textAlign, rotation: b.rotation, visibility: "hidden"}).add(a)
    }, setOffset: function (a, b) {
        var c = this.axis, d = c.chart, e = d.inverted, f = this.isNegative, g = c.translate(this.percent ? 100 : this.total, 0, 0, 0, 1),
            c = c.translate(0), c = M(g - c), h = d.xAxis[0].translate(this.x) + a, i = d.plotHeight, f = {x: e ? f ? g : g - c : h, y: e ? i - h - b : f ? i - g - c : i - g, width: e ? c : b, height: e ? b : c};
        if (e = this.label)e.align(this.alignOptions, null, f), f = e.alignAttr, e.attr({visibility: this.options.crop === !1 || d.isInsidePlot(f.x, f.y) ? V ? "inherit" : "visible" : "hidden"})
    }};
    sb.prototype = {init: function (a, b) {
        var c = b.borderWidth, d = b.style, e = z(d.padding);
        this.chart = a;
        this.options = b;
        this.crosshairs = [];
        this.now = {x: 0, y: 0};
        this.isHidden = !0;
        this.label = a.renderer.label("", 0, 0,
            b.shape, null, null, b.useHTML, null, "tooltip").attr({padding: e, fill: b.backgroundColor, "stroke-width": c, r: b.borderRadius, zIndex: 8}).css(d).css({padding: 0}).add().attr({y: -999});
        ba || this.label.shadow(b.shadow);
        this.shared = b.shared
    }, destroy: function () {
        if (this.label)this.label = this.label.destroy();
        clearTimeout(this.hideTimer);
        clearTimeout(this.tooltipTimeout)
    }, move: function (a, b, c, d) {
        var e = this, f = e.now, g = e.options.animation !== !1 && !e.isHidden;
        r(f, {x: g ? (2 * f.x + a) / 3 : a, y: g ? (f.y + b) / 2 : b, anchorX: g ? (2 * f.anchorX + c) /
            3 : c, anchorY: g ? (f.anchorY + d) / 2 : d});
        e.label.attr(f);
        if (g && (M(a - f.x) > 1 || M(b - f.y) > 1))clearTimeout(this.tooltipTimeout), this.tooltipTimeout = setTimeout(function () {
            e && e.move(a, b, c, d)
        }, 32)
    }, hide: function () {
        var a = this, b;
        clearTimeout(this.hideTimer);
        if (!this.isHidden)b = this.chart.hoverPoints, this.hideTimer = setTimeout(function () {
            a.label.fadeOut();
            a.isHidden = !0
        }, o(this.options.hideDelay, 500)), b && n(b, function (a) {
            a.setState()
        }), this.chart.hoverPoints = null
    }, getAnchor: function (a, b) {
        var c, d = this.chart, e = d.inverted,
            f = d.plotTop, g = 0, h = 0, i, a = ka(a);
        c = a[0].tooltipPos;
        this.followPointer && b && (b.chartX === u && (b = d.pointer.normalize(b)), c = [b.chartX - d.plotLeft, b.chartY - f]);
        c || (n(a, function (a) {
            i = a.series.yAxis;
            g += a.plotX;
            h += (a.plotLow ? (a.plotLow + a.plotHigh) / 2 : a.plotY) + (!e && i ? i.top - f : 0)
        }), g /= a.length, h /= a.length, c = [e ? d.plotWidth - h : g, this.shared && !e && a.length > 1 && b ? b.chartY - f : e ? d.plotHeight - g : h]);
        return Sa(c, w)
    }, getPosition: function (a, b, c) {
        var d = this.chart, e = d.plotLeft, f = d.plotTop, g = d.plotWidth, h = d.plotHeight, i = o(this.options.distance,
            12), j = c.plotX, c = c.plotY, d = j + e + (d.inverted ? i : -a - i), k = c - b + f + 15, l;
        d < 7 && (d = e + t(j, 0) + i);
        d + a > e + g && (d -= d + a - (e + g), k = c - b + f - i, l = !0);
        k < f + 5 && (k = f + 5, l && c >= k && c <= k + b && (k = c + f + i));
        k + b > f + h && (k = t(f, f + h - b - i));
        return{x: d, y: k}
    }, defaultFormatter: function (a) {
        var b = this.points || ka(this), c = b[0].series, d;
        d = [c.tooltipHeaderFormatter(b[0])];
        n(b, function (a) {
            c = a.series;
            d.push(c.tooltipFormatter && c.tooltipFormatter(a) || a.point.tooltipFormatter(c.tooltipOptions.pointFormat))
        });
        d.push(a.options.footerFormat || "");
        return d.join("")
    },
        refresh: function (a, b) {
            var c = this.chart, d = this.label, e = this.options, f, g, h = {}, i, j = [];
            i = e.formatter || this.defaultFormatter;
            var h = c.hoverPoints, k, l = this.shared;
            clearTimeout(this.hideTimer);
            this.followPointer = ka(a)[0].series.tooltipOptions.followPointer;
            g = this.getAnchor(a, b);
            f = g[0];
            g = g[1];
            l && (!a.series || !a.series.noSharedTooltip) ? (c.hoverPoints = a, h && n(h, function (a) {
                a.setState()
            }), n(a, function (a) {
                a.setState("hover");
                j.push(a.getLabelConfig())
            }), h = {x: a[0].category, y: a[0].y}, h.points = j, a = a[0]) : h = a.getLabelConfig();
            i = i.call(h, this);
            h = a.series;
            i === !1 ? this.hide() : (this.isHidden && (Ya(d), d.attr("opacity", 1).show()), d.attr({text: i}), k = e.borderColor || a.color || h.color || "#606060", d.attr({stroke: k}), this.updatePosition({plotX: f, plotY: g}), this.isHidden = !1);
            A(c, "tooltipRefresh", {text: i, x: f + c.plotLeft, y: g + c.plotTop, borderColor: k})
        }, updatePosition: function (a) {
            var b = this.chart, c = this.label, c = (this.options.positioner || this.getPosition).call(this, c.width, c.height, a);
            this.move(w(c.x), w(c.y), a.plotX + b.plotLeft, a.plotY + b.plotTop)
        }};
    var Za = Highcharts.Pointer = function (a, b) {
        this.init(a, b)
    };
    Za.prototype = {init: function (a, b) {
        var c = b.chart, d = c.events, e = ba ? "" : c.zoomType, c = a.inverted, f;
        this.options = b;
        this.chart = a;
        this.zoomX = f = /x/.test(e);
        this.zoomY = e = /y/.test(e);
        this.zoomHor = f && !c || e && c;
        this.zoomVert = e && !c || f && c;
        this.runChartClick = d && !!d.click;
        this.pinchDown = [];
        this.lastValidTouch = {};
        if (b.tooltip.enabled)a.tooltip = new sb(a, b.tooltip);
        this.setDOMEvents()
    }, normalize: function (a, b) {
        var c, d, a = a || C.event;
        if (!a.target)a.target = a.srcElement;
        a = Rb(a);
        d = a.touches ? a.touches.item(0) : a;
        if (!b)this.chartPosition = b = Qb(this.chart.container);
        d.pageX === u ? (c = t(a.x, a.clientX - b.left), d = a.y) : (c = d.pageX - b.left, d = d.pageY - b.top);
        return r(a, {chartX: w(c), chartY: w(d)})
    }, getCoordinates: function (a) {
        var b = {xAxis: [], yAxis: []};
        n(this.chart.axes, function (c) {
            b[c.isXAxis ? "xAxis" : "yAxis"].push({axis: c, value: c.toValue(a[c.horiz ? "chartX" : "chartY"])})
        });
        return b
    }, getIndex: function (a) {
        var b = this.chart;
        return b.inverted ? b.plotHeight + b.plotTop - a.chartY : a.chartX - b.plotLeft
    },
        runPointActions: function (a) {
            var b = this, c = b.chart, d = c.series, e = c.tooltip, f, g, h = c.hoverPoint, i = c.hoverSeries, j, k, l = c.chartWidth, m = b.getIndex(a);
            if (e && b.options.tooltip.shared && (!i || !i.noSharedTooltip)) {
                g = [];
                j = d.length;
                for (k = 0; k < j; k++)if (d[k].visible && d[k].options.enableMouseTracking !== !1 && !d[k].noSharedTooltip && d[k].tooltipPoints.length && (f = d[k].tooltipPoints[m]) && f.series)f._dist = M(m - f.clientX), l = I(l, f._dist), g.push(f);
                for (j = g.length; j--;)g[j]._dist > l && g.splice(j, 1);
                if (g.length && g[0].clientX !== b.hoverX)e.refresh(g,
                    a), b.hoverX = g[0].clientX
            }
            if (i && i.tracker) {
                if ((f = i.tooltipPoints[m]) && f !== h)f.onMouseOver(a)
            } else e && e.followPointer && !e.isHidden && (d = e.getAnchor([
                {}
            ], a), e.updatePosition({plotX: d[0], plotY: d[1]}));
            if (e && !b._onDocumentMouseMove)b._onDocumentMouseMove = function (a) {
                b.onDocumentMouseMove(a)
            }, F(v, "mousemove", b._onDocumentMouseMove);
            n(c.axes, function (b) {
                b.drawCrosshair(a, o(h, f))
            })
        }, reset: function (a) {
            var b = this.chart, c = b.hoverSeries, d = b.hoverPoint, e = b.tooltip, f = e && e.shared ? b.hoverPoints : d;
            (a = a && e && f) && ka(f)[0].plotX ===
                u && (a = !1);
            if (a)e.refresh(f), d && d.setState(d.state, !0); else {
                if (d)d.onMouseOut();
                if (c)c.onMouseOut();
                e && e.hide();
                if (this._onDocumentMouseMove)X(v, "mousemove", this._onDocumentMouseMove), this._onDocumentMouseMove = null;
                n(b.axes, function (a) {
                    a.hideCrosshair()
                });
                this.hoverX = null
            }
        }, scaleGroups: function (a, b) {
            var c = this.chart, d;
            n(c.series, function (e) {
                d = a || e.getPlotBox();
                e.xAxis && e.xAxis.zoomEnabled && (e.group.attr(d), e.markerGroup && (e.markerGroup.attr(d), e.markerGroup.clip(b ? c.clipRect : null)), e.dataLabelsGroup &&
                    e.dataLabelsGroup.attr(d))
            });
            c.clipRect.attr(b || c.clipBox)
        }, pinchTranslate: function (a, b, c, d, e, f, g, h) {
            a && this.pinchTranslateDirection(!0, c, d, e, f, g, h);
            b && this.pinchTranslateDirection(!1, c, d, e, f, g, h)
        }, pinchTranslateDirection: function (a, b, c, d, e, f, g, h) {
            var i = this.chart, j = a ? "x" : "y", k = a ? "X" : "Y", l = "chart" + k, m = a ? "width" : "height", p = i["plot" + (a ? "Left" : "Top")], q, o, n = h || 1, t = i.inverted, w = i.bounds[a ? "h" : "v"], r = b.length === 1, s = b[0][l], u = c[0][l], v = !r && b[1][l], x = !r && c[1][l], y, c = function () {
                !r && M(s - v) > 20 && (n = h || M(u - x) /
                    M(s - v));
                o = (p - u) / n + s;
                q = i["plot" + (a ? "Width" : "Height")] / n
            };
            c();
            b = o;
            b < w.min ? (b = w.min, y = !0) : b + q > w.max && (b = w.max - q, y = !0);
            y ? (u -= 0.8 * (u - g[j][0]), r || (x -= 0.8 * (x - g[j][1])), c()) : g[j] = [u, x];
            t || (f[j] = o - p, f[m] = q);
            f = t ? 1 / n : n;
            e[m] = q;
            e[j] = b;
            d[t ? a ? "scaleY" : "scaleX" : "scale" + k] = n;
            d["translate" + k] = f * p + (u - f * s)
        }, pinch: function (a) {
            var b = this, c = b.chart, d = b.pinchDown, e = c.tooltip && c.tooltip.options.followTouchMove, f = a.touches, g = f.length, h = b.lastValidTouch, i = b.zoomHor || b.pinchHor, j = b.zoomVert || b.pinchVert, k = i || j, l = b.selectionMarker,
                m = {}, p = g === 1 && (b.inClass(a.target, "highcharts-tracker") && c.runTrackerClick || c.runChartClick), q = {};
            (k || e) && !p && a.preventDefault();
            Sa(f, function (a) {
                return b.normalize(a)
            });
            if (a.type === "touchstart")n(f, function (a, b) {
                d[b] = {chartX: a.chartX, chartY: a.chartY}
            }), h.x = [d[0].chartX, d[1] && d[1].chartX], h.y = [d[0].chartY, d[1] && d[1].chartY], n(c.axes, function (a) {
                if (a.zoomEnabled) {
                    var b = c.bounds[a.horiz ? "h" : "v"], d = a.minPixelPadding, e = a.toPixels(a.dataMin), f = a.toPixels(a.dataMax), g = I(e, f), e = t(e, f);
                    b.min = I(a.pos, g - d);
                    b.max = t(a.pos + a.len, e + d)
                }
            }); else if (d.length) {
                if (!l)b.selectionMarker = l = r({destroy: ma}, c.plotBox);
                b.pinchTranslate(i, j, d, f, m, l, q, h);
                b.hasPinched = k;
                b.scaleGroups(m, q);
                !k && e && g === 1 && this.runPointActions(b.normalize(a))
            }
        }, dragStart: function (a) {
            var b = this.chart;
            b.mouseIsDown = a.type;
            b.cancelClick = !1;
            b.mouseDownX = this.mouseDownX = a.chartX;
            b.mouseDownY = this.mouseDownY = a.chartY
        }, drag: function (a) {
            var b = this.chart, c = b.options.chart, d = a.chartX, e = a.chartY, f = this.zoomHor, g = this.zoomVert, h = b.plotLeft, i = b.plotTop,
                j = b.plotWidth, k = b.plotHeight, l, m = this.mouseDownX, p = this.mouseDownY;
            d < h ? d = h : d > h + j && (d = h + j);
            e < i ? e = i : e > i + k && (e = i + k);
            this.hasDragged = Math.sqrt(Math.pow(m - d, 2) + Math.pow(p - e, 2));
            if (this.hasDragged > 10) {
                l = b.isInsidePlot(m - h, p - i);
                if (b.hasCartesianSeries && (this.zoomX || this.zoomY) && l && !this.selectionMarker)this.selectionMarker = b.renderer.rect(h, i, f ? 1 : j, g ? 1 : k, 0).attr({fill: c.selectionMarkerFill || "rgba(69,114,167,0.25)", zIndex: 7}).add();
                this.selectionMarker && f && (d -= m, this.selectionMarker.attr({width: M(d), x: (d >
                    0 ? 0 : d) + m}));
                this.selectionMarker && g && (d = e - p, this.selectionMarker.attr({height: M(d), y: (d > 0 ? 0 : d) + p}));
                l && !this.selectionMarker && c.panning && b.pan(a, c.panning)
            }
        }, drop: function (a) {
            var b = this.chart, c = this.hasPinched;
            if (this.selectionMarker) {
                var d = {xAxis: [], yAxis: [], originalEvent: a.originalEvent || a}, e = this.selectionMarker, f = e.x, g = e.y, h;
                if (this.hasDragged || c)n(b.axes, function (a) {
                    if (a.zoomEnabled) {
                        var b = a.horiz, c = a.toValue(b ? f : g), b = a.toValue(b ? f + e.width : g + e.height);
                        !isNaN(c) && !isNaN(b) && (d[a.coll].push({axis: a,
                            min: I(c, b), max: t(c, b)}), h = !0)
                    }
                }), h && A(b, "selection", d, function (a) {
                    b.zoom(r(a, c ? {animation: !1} : null))
                });
                this.selectionMarker = this.selectionMarker.destroy();
                c && this.scaleGroups()
            }
            if (b)D(b.container, {cursor: b._cursor}), b.cancelClick = this.hasDragged > 10, b.mouseIsDown = this.hasDragged = this.hasPinched = !1, this.pinchDown = []
        }, onContainerMouseDown: function (a) {
            a = this.normalize(a);
            a.preventDefault && a.preventDefault();
            this.dragStart(a)
        }, onDocumentMouseUp: function (a) {
            this.drop(a)
        }, onDocumentMouseMove: function (a) {
            var b =
                this.chart, c = this.chartPosition, d = b.hoverSeries, a = this.normalize(a, c);
            c && d && !this.inClass(a.target, "highcharts-tracker") && !b.isInsidePlot(a.chartX - b.plotLeft, a.chartY - b.plotTop) && this.reset()
        }, onContainerMouseLeave: function () {
            this.reset();
            this.chartPosition = null
        }, onContainerMouseMove: function (a) {
            var b = this.chart, a = this.normalize(a);
            b.mouseIsDown === "mousedown" && this.drag(a);
            (this.inClass(a.target, "highcharts-tracker") || b.isInsidePlot(a.chartX - b.plotLeft, a.chartY - b.plotTop)) && !b.openMenu && this.runPointActions(a)
        },
        inClass: function (a, b) {
            for (var c; a;) {
                if (c = y(a, "class"))if (c.indexOf(b) !== -1)return!0; else if (c.indexOf("highcharts-container") !== -1)return!1;
                a = a.parentNode
            }
        }, onTrackerMouseOut: function (a) {
            var b = this.chart.hoverSeries, a = a.relatedTarget || a.toElement, c = a.point && a.point.series;
            if (b && !b.options.stickyTracking && !this.inClass(a, "highcharts-tooltip") && c !== b)b.onMouseOut()
        }, onContainerClick: function (a) {
            var b = this.chart, c = b.hoverPoint, d = b.plotLeft, e = b.plotTop, f = b.inverted, g, h, i, a = this.normalize(a);
            a.cancelBubble = !0;
            if (!b.cancelClick)c && this.inClass(a.target, "highcharts-tracker") ? (g = this.chartPosition, h = c.plotX, i = c.plotY, r(c, {pageX: g.left + d + (f ? b.plotWidth - i : h), pageY: g.top + e + (f ? b.plotHeight - h : i)}), A(c.series, "click", r(a, {point: c})), b.hoverPoint && c.firePointEvent("click", a)) : (r(a, this.getCoordinates(a)), b.isInsidePlot(a.chartX - d, a.chartY - e) && A(b, "click", a))
        }, onContainerTouchStart: function (a) {
            var b = this.chart;
            a.touches.length === 1 ? (a = this.normalize(a), b.isInsidePlot(a.chartX - b.plotLeft, a.chartY - b.plotTop) ? (this.runPointActions(a),
                this.pinch(a)) : this.reset()) : a.touches.length === 2 && this.pinch(a)
        }, onContainerTouchMove: function (a) {
            (a.touches.length === 1 || a.touches.length === 2) && this.pinch(a)
        }, onDocumentTouchEnd: function (a) {
            this.drop(a)
        }, setDOMEvents: function () {
            var a = this, b = a.chart.container, c;
            this._events = c = [
                [b, "onmousedown", "onContainerMouseDown"],
                [b, "onmousemove", "onContainerMouseMove"],
                [b, "onclick", "onContainerClick"],
                [b, "mouseleave", "onContainerMouseLeave"],
                [v, "mouseup", "onDocumentMouseUp"]
            ];
            hb && c.push([b, "ontouchstart", "onContainerTouchStart"],
                [b, "ontouchmove", "onContainerTouchMove"], [v, "touchend", "onDocumentTouchEnd"]);
            n(c, function (b) {
                a["_" + b[2]] = function (c) {
                    a[b[2]](c)
                };
                b[1].indexOf("on") === 0 ? b[0][b[1]] = a["_" + b[2]] : F(b[0], b[1], a["_" + b[2]])
            })
        }, destroy: function () {
            var a = this;
            n(a._events, function (b) {
                b[1].indexOf("on") === 0 ? b[0][b[1]] = null : X(b[0], b[1], a["_" + b[2]])
            });
            delete a._events;
            clearInterval(a.tooltipTimeout)
        }};
    J = Highcharts.TrackerMixin = {drawTrackerPoint: function () {
        var a = this, b = a.chart, c = b.pointer, d = a.options.cursor, e = d && {cursor: d}, f = function (c) {
            var d =
                c.target, e;
            if (b.hoverSeries !== a)a.onMouseOver();
            for (; d && !e;)e = d.point, d = d.parentNode;
            if (e !== u && e !== b.hoverPoint)e.onMouseOver(c)
        };
        n(a.points, function (a) {
            if (a.graphic)a.graphic.element.point = a;
            if (a.dataLabel)a.dataLabel.element.point = a
        });
        if (!a._hasTracking)n(a.trackerGroups, function (b) {
            if (a[b] && (a[b].addClass("highcharts-tracker").on("mouseover", f).on("mouseout", function (a) {
                c.onTrackerMouseOut(a)
            }).css(e), hb))a[b].on("touchstart", f)
        }), a._hasTracking = !0
    }, drawTrackerGraph: function () {
        var a = this, b = a.options,
            c = b.trackByArea, d = [].concat(c ? a.areaPath : a.graphPath), e = d.length, f = a.chart, g = f.pointer, h = f.renderer, i = f.options.tooltip.snap, j = a.tracker, k = b.cursor, l = k && {cursor: k}, k = a.singlePoints, m, p = function () {
                if (f.hoverSeries !== a)a.onMouseOver()
            };
        if (e && !c)for (m = e + 1; m--;)d[m] === "M" && d.splice(m + 1, 0, d[m + 1] - i, d[m + 2], "L"), (m && d[m] === "M" || m === e) && d.splice(m, 0, "L", d[m - 2] + i, d[m - 1]);
        for (m = 0; m < k.length; m++)e = k[m], d.push("M", e.plotX - i, e.plotY, "L", e.plotX + i, e.plotY);
        j ? j.attr({d: d}) : (a.tracker = h.path(d).attr({"stroke-linejoin": "round",
            visibility: a.visible ? "visible" : "hidden", stroke: Kb, fill: c ? Kb : Q, "stroke-width": b.lineWidth + (c ? 0 : 2 * i), zIndex: 2}).add(a.group), n([a.tracker, a.markerGroup], function (a) {
            a.addClass("highcharts-tracker").on("mouseover", p).on("mouseout", function (a) {
                g.onTrackerMouseOut(a)
            }).css(l);
            if (hb)a.on("touchstart", p)
        }))
    }};
    if (C.PointerEvent || C.MSPointerEvent) {
        var oa = {};
        Za.prototype.getWebkitTouches = function () {
            var a, b = [];
            b.item = function (a) {
                return this[a]
            };
            for (a in oa)oa.hasOwnProperty(a) && b.push({pageX: oa[a].pageX, pageY: oa[a].pageY,
                target: oa[a].target});
            return b
        };
        Ua(Za.prototype, "init", function (a, b, c) {
            b.container.style["-ms-touch-action"] = b.container.style["touch-action"] = "none";
            a.call(this, b, c)
        });
        Ua(Za.prototype, "setDOMEvents", function (a) {
            var b = this;
            a.apply(this, Array.prototype.slice.call(arguments, 1));
            n([
                [this.chart.container, "PointerDown", "touchstart", "onContainerTouchStart", function (a) {
                    oa[a.pointerId] = {pageX: a.pageX, pageY: a.pageY, target: a.currentTarget}
                }],
                [this.chart.container, "PointerMove", "touchmove", "onContainerTouchMove",
                    function (a) {
                        oa[a.pointerId] = {pageX: a.pageX, pageY: a.pageY};
                        if (!oa[a.pointerId].target)oa[a.pointerId].target = a.currentTarget
                    }],
                [document, "PointerUp", "touchend", "onDocumentTouchEnd", function (a) {
                    delete oa[a.pointerId]
                }]
            ], function (a) {
                F(a[0], window.PointerEvent ? a[1].toLowerCase() : "MS" + a[1], function (d) {
                    d = d.originalEvent;
                    if (d.pointerType === "touch" || d.pointerType === d.MSPOINTER_TYPE_TOUCH)a[4](d), b[a[3]]({type: a[2], target: d.currentTarget, preventDefault: ma, touches: b.getWebkitTouches()})
                })
            })
        })
    }
    var zb = Highcharts.Legend =
        function (a, b) {
            this.init(a, b)
        };
    zb.prototype = {init: function (a, b) {
        var c = this, d = b.itemStyle, e = o(b.padding, 8), f = b.itemMarginTop || 0;
        this.options = b;
        if (b.enabled)c.baseline = z(d.fontSize) + 3 + f, c.itemStyle = d, c.itemHiddenStyle = x(d, b.itemHiddenStyle), c.itemMarginTop = f, c.padding = e, c.initialItemX = e, c.initialItemY = e - 5, c.maxItemWidth = 0, c.chart = a, c.itemHeight = 0, c.lastLineHeight = 0, c.symbolWidth = o(b.symbolWidth, 16), c.pages = [], c.render(), F(c.chart, "endResize", function () {
            c.positionCheckboxes()
        })
    }, colorizeItem: function (a, b) {
        var c = this.options, d = a.legendItem, e = a.legendLine, f = a.legendSymbol, g = this.itemHiddenStyle.color, c = b ? c.itemStyle.color : g, h = b ? a.legendColor || a.color : g, g = a.options && a.options.marker, i = {stroke: h, fill: h}, j;
        d && d.css({fill: c, color: c});
        e && e.attr({stroke: h});
        if (f) {
            if (g && f.isMarker)for (j in g = a.convertAttribs(g), g)d = g[j], d !== u && (i[j] = d);
            f.attr(i)
        }
    }, positionItem: function (a) {
        var b = this.options, c = b.symbolPadding, b = !b.rtl, d = a._legendItemPos, e = d[0], d = d[1], f = a.checkbox;
        a.legendGroup && a.legendGroup.translate(b ?
            e : this.legendWidth - e - 2 * c - 4, d);
        if (f)f.x = e, f.y = d
    }, destroyItem: function (a) {
        var b = a.checkbox;
        n(["legendItem", "legendLine", "legendSymbol", "legendGroup"], function (b) {
            a[b] && (a[b] = a[b].destroy())
        });
        b && Oa(a.checkbox)
    }, destroy: function () {
        var a = this.group, b = this.box;
        if (b)this.box = b.destroy();
        if (a)this.group = a.destroy()
    }, positionCheckboxes: function (a) {
        var b = this.group.alignAttr, c, d = this.clipHeight || this.legendHeight;
        if (b)c = b.translateY, n(this.allItems, function (e) {
            var f = e.checkbox, g;
            f && (g = c + f.y + (a || 0) + 3, D(f, {left: b.translateX +
                e.legendItemWidth + f.x - 20 + "px", top: g + "px", display: g > c - 6 && g < c + d - 6 ? "" : Q}))
        })
    }, renderTitle: function () {
        var a = this.padding, b = this.options.title, c = 0;
        if (b.text) {
            if (!this.title)this.title = this.chart.renderer.label(b.text, a - 3, a - 4, null, null, null, null, null, "legend-title").attr({zIndex: 1}).css(b.style).add(this.group);
            a = this.title.getBBox();
            c = a.height;
            this.offsetWidth = a.width;
            this.contentGroup.attr({translateY: c})
        }
        this.titleHeight = c
    }, renderItem: function (a) {
        var B;
        var b = this, c = b.chart, d = c.renderer, e = b.options, f =
            e.layout === "horizontal", g = b.symbolWidth, h = e.symbolPadding, i = b.itemStyle, j = b.itemHiddenStyle, k = b.padding, l = f ? o(e.itemDistance, 8) : 0, m = !e.rtl, p = e.width, q = e.itemMarginBottom || 0, n = b.itemMarginTop, r = b.initialItemX, s = a.legendItem, u = a.series && a.series.drawLegendSymbol ? a.series : a, v = u.options, v = v && v.showCheckbox, y = e.useHTML;
        if (!s && (a.legendGroup = d.g("legend-item").attr({zIndex: 1}).add(b.scrollGroup), u.drawLegendSymbol(b, a), a.legendItem = s = d.text(e.labelFormat ? Ga(e.labelFormat, a) : e.labelFormatter.call(a), m ? g +
            h : -h, b.baseline, y).css(x(a.visible ? i : j)).attr({align: m ? "left" : "right", zIndex: 2}).add(a.legendGroup), (y ? s : a.legendGroup).on("mouseover", function () {
            a.setState("hover");
            s.css(b.options.itemHoverStyle)
        }).on("mouseout", function () {
            s.css(a.visible ? i : j);
            a.setState()
        }).on("click", function (b) {
            var c = function () {
                a.setVisible()
            }, b = {browserEvent: b};
            a.firePointEvent ? a.firePointEvent("legendItemClick", b, c) : A(a, "legendItemClick", b, c)
        }), b.colorizeItem(a, a.visible), v))a.checkbox = T("input", {type: "checkbox", checked: a.selected,
            defaultChecked: a.selected}, e.itemCheckboxStyle, c.container), F(a.checkbox, "click", function (b) {
            A(a, "checkboxClick", {checked: b.target.checked}, function () {
                a.select()
            })
        });
        d = s.getBBox();
        B = a.legendItemWidth = e.itemWidth || a.legendItemWidth || g + h + d.width + l + (v ? 20 : 0), e = B;
        b.itemHeight = g = w(a.legendItemHeight || d.height);
        if (f && b.itemX - r + e > (p || c.chartWidth - 2 * k - r))b.itemX = r, b.itemY += n + b.lastLineHeight + q, b.lastLineHeight = 0;
        b.maxItemWidth = t(b.maxItemWidth, e);
        b.lastItemY = n + b.itemY + q;
        b.lastLineHeight = t(g, b.lastLineHeight);
        a._legendItemPos = [b.itemX, b.itemY];
        f ? b.itemX += e : (b.itemY += n + g + q, b.lastLineHeight = g);
        b.offsetWidth = p || t((f ? b.itemX - r - l : e) + k, b.offsetWidth)
    }, getAllItems: function () {
        var a = [];
        n(this.chart.series, function (b) {
            var c = b.options;
            if (o(c.showInLegend, !s(c.linkedTo) ? u : !1, !0))a = a.concat(b.legendItems || (c.legendType === "point" ? b.data : b))
        });
        return a
    }, render: function () {
        var a = this, b = a.chart, c = b.renderer, d = a.group, e, f, g, h, i = a.box, j = a.options, k = a.padding, l = j.borderWidth, m = j.backgroundColor;
        a.itemX = a.initialItemX;
        a.itemY =
            a.initialItemY;
        a.offsetWidth = 0;
        a.lastItemY = 0;
        if (!d)a.group = d = c.g("legend").attr({zIndex: 7}).add(), a.contentGroup = c.g().attr({zIndex: 1}).add(d), a.scrollGroup = c.g().add(a.contentGroup);
        a.renderTitle();
        e = a.getAllItems();
        nb(e, function (a, b) {
            return(a.options && a.options.legendIndex || 0) - (b.options && b.options.legendIndex || 0)
        });
        j.reversed && e.reverse();
        a.allItems = e;
        a.display = f = !!e.length;
        n(e, function (b) {
            a.renderItem(b)
        });
        g = j.width || a.offsetWidth;
        h = a.lastItemY + a.lastLineHeight + a.titleHeight;
        h = a.handleOverflow(h);
        if (l || m) {
            g += k;
            h += k;
            if (i) {
                if (g > 0 && h > 0)i[i.isNew ? "attr" : "animate"](i.crisp(null, null, null, g, h)), i.isNew = !1
            } else a.box = i = c.rect(0, 0, g, h, j.borderRadius, l || 0).attr({stroke: j.borderColor, "stroke-width": l || 0, fill: m || Q}).add(d).shadow(j.shadow), i.isNew = !0;
            i[f ? "show" : "hide"]()
        }
        a.legendWidth = g;
        a.legendHeight = h;
        n(e, function (b) {
            a.positionItem(b)
        });
        f && d.align(r({width: g, height: h}, j), !0, "spacingBox");
        b.isResizing || this.positionCheckboxes()
    }, handleOverflow: function (a) {
        var b = this, c = this.chart, d = c.renderer, e = this.options,
            f = e.y, f = c.spacingBox.height + (e.verticalAlign === "top" ? -f : f) - this.padding, g = e.maxHeight, h, i = this.clipRect, j = e.navigation, k = o(j.animation, !0), l = j.arrowSize || 12, m = this.nav, p = this.pages, q, t = this.allItems;
        e.layout === "horizontal" && (f /= 2);
        g && (f = I(f, g));
        p.length = 0;
        if (a > f && !e.useHTML) {
            this.clipHeight = h = f - 20 - this.titleHeight - this.padding;
            this.currentPage = o(this.currentPage, 1);
            this.fullHeight = a;
            n(t, function (a, b) {
                var c = a._legendItemPos[1], d = w(a.legendItem.bBox.height), e = p.length;
                if (!e || c - p[e - 1] > h)p.push(q || c);
                b === t.length - 1 && c + d - p[e - 1] > h && p.push(c);
                c !== q && (q = c)
            });
            if (!i)i = b.clipRect = d.clipRect(0, this.padding, 9999, 0), b.contentGroup.clip(i);
            i.attr({height: h});
            if (!m)this.nav = m = d.g().attr({zIndex: 1}).add(this.group), this.up = d.symbol("triangle", 0, 0, l, l).on("click", function () {
                b.scroll(-1, k)
            }).add(m), this.pager = d.text("", 15, 10).css(j.style).add(m), this.down = d.symbol("triangle-down", 0, 0, l, l).on("click", function () {
                b.scroll(1, k)
            }).add(m);
            b.scroll(0);
            a = f
        } else if (m)i.attr({height: c.chartHeight}), m.hide(), this.scrollGroup.attr({translateY: 1}),
            this.clipHeight = 0;
        return a
    }, scroll: function (a, b) {
        var c = this.pages, d = c.length, e = this.currentPage + a, f = this.clipHeight, g = this.options.navigation, h = g.activeColor, g = g.inactiveColor, i = this.pager, j = this.padding;
        e > d && (e = d);
        if (e > 0)b !== u && Pa(b, this.chart), this.nav.attr({translateX: j, translateY: f + this.padding + 7 + this.titleHeight, visibility: "visible"}), this.up.attr({fill: e === 1 ? g : h}).css({cursor: e === 1 ? "default" : "pointer"}), i.attr({text: e + "/" + d}), this.down.attr({x: 18 + this.pager.getBBox().width, fill: e === d ? g : h}).css({cursor: e ===
            d ? "default" : "pointer"}), c = -c[e - 1] + this.initialItemY, this.scrollGroup.animate({translateY: c}), this.currentPage = e, this.positionCheckboxes(c)
    }};
    R = Highcharts.LegendSymbolMixin = {drawRectangle: function (a, b) {
        var c = a.options.symbolHeight || 12;
        b.legendSymbol = this.chart.renderer.rect(0, a.baseline - 5 - c / 2, a.symbolWidth, c, o(a.options.symbolRadius, 2)).attr({zIndex: 3}).add(b.legendGroup)
    }, drawLineMarker: function (a) {
        var b = this.options, c = b.marker, d;
        d = a.symbolWidth;
        var e = this.chart.renderer, f = this.legendGroup, a = a.baseline -
            w(e.fontMetrics(a.options.itemStyle.fontSize).b * 0.3), g;
        if (b.lineWidth) {
            g = {"stroke-width": b.lineWidth};
            if (b.dashStyle)g.dashstyle = b.dashStyle;
            this.legendLine = e.path(["M", 0, a, "L", d, a]).attr(g).add(f)
        }
        if (c && c.enabled)b = c.radius, this.legendSymbol = d = e.symbol(this.symbol, d / 2 - b, a - b, 2 * b, 2 * b).add(f), d.isMarker = !0
    }};
    /Trident\/7\.0/.test(sa) && Ua(zb.prototype, "positionItem", function (a, b) {
        var c = this, d = function () {
            b._legendItemPos && a.call(c, b)
        };
        c.chart.renderer.forExport ? d() : setTimeout(d)
    });
    eb.prototype = {init: function (a, b) {
        var c, d = a.series;
        a.series = null;
        c = x(G, a);
        c.series = a.series = d;
        this.userOptions = a;
        d = c.chart;
        this.margin = this.splashArray("margin", d);
        this.spacing = this.splashArray("spacing", d);
        var e = d.events;
        this.bounds = {h: {}, v: {}};
        this.callback = b;
        this.isResizing = 0;
        this.options = c;
        this.axes = [];
        this.series = [];
        this.hasCartesianSeries = d.showAxes;
        var f = this, g;
        f.index = Ja.length;
        Ja.push(f);
        d.reflow !== !1 && F(f, "load", function () {
            f.initReflow()
        });
        if (e)for (g in e)F(f, g, e[g]);
        f.xAxis = [];
        f.yAxis = [];
        f.animation = ba ? !1 : o(d.animation,
            !0);
        f.pointCount = 0;
        f.counters = new Ab;
        f.firstRender()
    }, initSeries: function (a) {
        var b = this.options.chart;
        (b = L[a.type || b.type || b.defaultSeriesType]) || la(17, !0);
        b = new b;
        b.init(this, a);
        return b
    }, isInsidePlot: function (a, b, c) {
        var d = c ? b : a, a = c ? a : b;
        return d >= 0 && d <= this.plotWidth && a >= 0 && a <= this.plotHeight
    }, adjustTickAmounts: function () {
        this.options.chart.alignTicks !== !1 && n(this.axes, function (a) {
            a.adjustTickAmount()
        });
        this.maxTicks = null
    }, redraw: function (a) {
        var b = this.axes, c = this.series, d = this.pointer, e = this.legend,
            f = this.isDirtyLegend, g, h, i = this.isDirtyBox, j = c.length, k = j, l = this.renderer, m = l.isHidden(), p = [];
        Pa(a, this);
        m && this.cloneRenderTo();
        for (this.layOutTitles(); k--;)if (a = c[k], a.options.stacking && (g = !0, a.isDirty)) {
            h = !0;
            break
        }
        if (h)for (k = j; k--;)if (a = c[k], a.options.stacking)a.isDirty = !0;
        n(c, function (a) {
            a.isDirty && a.options.legendType === "point" && (f = !0)
        });
        if (f && e.options.enabled)e.render(), this.isDirtyLegend = !1;
        g && this.getStacks();
        if (this.hasCartesianSeries) {
            if (!this.isResizing)this.maxTicks = null, n(b, function (a) {
                a.setScale()
            });
            this.adjustTickAmounts();
            this.getMargins();
            n(b, function (a) {
                a.isDirty && (i = !0)
            });
            n(b, function (a) {
                if (a.isDirtyExtremes)a.isDirtyExtremes = !1, p.push(function () {
                    A(a, "afterSetExtremes", r(a.eventArgs, a.getExtremes()));
                    delete a.eventArgs
                });
                (i || g) && a.redraw()
            })
        }
        i && this.drawChartBox();
        n(c, function (a) {
            a.isDirty && a.visible && (!a.isCartesian || a.xAxis) && a.redraw()
        });
        d && d.reset && d.reset(!0);
        l.draw();
        A(this, "redraw");
        m && this.cloneRenderTo(!0);
        n(p, function (a) {
            a.call()
        })
    }, get: function (a) {
        var b = this.axes, c = this.series,
            d, e;
        for (d = 0; d < b.length; d++)if (b[d].options.id === a)return b[d];
        for (d = 0; d < c.length; d++)if (c[d].options.id === a)return c[d];
        for (d = 0; d < c.length; d++) {
            e = c[d].points || [];
            for (b = 0; b < e.length; b++)if (e[b].id === a)return e[b]
        }
        return null
    }, getAxes: function () {
        var a = this, b = this.options, c = b.xAxis = ka(b.xAxis || {}), b = b.yAxis = ka(b.yAxis || {});
        n(c, function (a, b) {
            a.index = b;
            a.isX = !0
        });
        n(b, function (a, b) {
            a.index = b
        });
        c = c.concat(b);
        n(c, function (b) {
            new ra(a, b)
        });
        a.adjustTickAmounts()
    }, getSelectedPoints: function () {
        var a = [];
        n(this.series,
            function (b) {
                a = a.concat(vb(b.points || [], function (a) {
                    return a.selected
                }))
            });
        return a
    }, getSelectedSeries: function () {
        return vb(this.series, function (a) {
            return a.selected
        })
    }, getStacks: function () {
        var a = this;
        n(a.yAxis, function (a) {
            if (a.stacks && a.hasVisibleSeries)a.oldStacks = a.stacks
        });
        n(a.series, function (b) {
            if (b.options.stacking && (b.visible === !0 || a.options.chart.ignoreHiddenSeries === !1))b.stackKey = b.type + o(b.options.stack, "")
        })
    }, showResetZoom: function () {
        var a = this, b = G.lang, c = a.options.chart.resetZoomButton,
            d = c.theme, e = d.states, f = c.relativeTo === "chart" ? null : "plotBox";
        this.resetZoomButton = a.renderer.button(b.resetZoom, null, null, function () {
            a.zoomOut()
        }, d, e && e.hover).attr({align: c.position.align, title: b.resetZoomTitle}).add().align(c.position, !1, f)
    }, zoomOut: function () {
        var a = this;
        A(a, "selection", {resetSelection: !0}, function () {
            a.zoom()
        })
    }, zoom: function (a) {
        var b, c = this.pointer, d = !1, e;
        !a || a.resetSelection ? n(this.axes, function (a) {
            b = a.zoom()
        }) : n(a.xAxis.concat(a.yAxis), function (a) {
            var e = a.axis, h = e.isXAxis;
            if (c[h ?
                "zoomX" : "zoomY"] || c[h ? "pinchX" : "pinchY"])b = e.zoom(a.min, a.max), e.displayBtn && (d = !0)
        });
        e = this.resetZoomButton;
        if (d && !e)this.showResetZoom(); else if (!d && S(e))this.resetZoomButton = e.destroy();
        b && this.redraw(o(this.options.chart.animation, a && a.animation, this.pointCount < 100))
    }, pan: function (a, b) {
        var c = this, d = c.hoverPoints, e;
        d && n(d, function (a) {
            a.setState()
        });
        n(b === "xy" ? [1, 0] : [1], function (b) {
            var d = a[b ? "chartX" : "chartY"], h = c[b ? "xAxis" : "yAxis"][0], i = c[b ? "mouseDownX" : "mouseDownY"], j = (h.pointRange || 0) / 2, k = h.getExtremes(),
                l = h.toValue(i - d, !0) + j, i = h.toValue(i + c[b ? "plotWidth" : "plotHeight"] - d, !0) - j;
            h.series.length && l > I(k.dataMin, k.min) && i < t(k.dataMax, k.max) && (h.setExtremes(l, i, !1, !1, {trigger: "pan"}), e = !0);
            c[b ? "mouseDownX" : "mouseDownY"] = d
        });
        e && c.redraw(!1);
        D(c.container, {cursor: "move"})
    }, setTitle: function (a, b) {
        var f;
        var c = this, d = c.options, e;
        e = d.title = x(d.title, a);
        f = d.subtitle = x(d.subtitle, b), d = f;
        n([
            ["title", a, e],
            ["subtitle", b, d]
        ], function (a) {
            var b = a[0], d = c[b], e = a[1], a = a[2];
            d && e && (c[b] = d = d.destroy());
            a && a.text && !d && (c[b] =
                c.renderer.text(a.text, 0, 0, a.useHTML).attr({align: a.align, "class": "highcharts-" + b, zIndex: a.zIndex || 4}).css(a.style).add())
        });
        c.layOutTitles()
    }, layOutTitles: function () {
        var a = 0, b = this.title, c = this.subtitle, d = this.options, e = d.title, d = d.subtitle, f = this.spacingBox.width - 44;
        if (b && (b.css({width: (e.width || f) + "px"}).align(r({y: 15}, e), !1, "spacingBox"), !e.floating && !e.verticalAlign))a = b.getBBox().height, a >= 18 && a <= 25 && (a = 15);
        c && (c.css({width: (d.width || f) + "px"}).align(r({y: a + e.margin}, d), !1, "spacingBox"), !d.floating && !d.verticalAlign && (a = Ia(a + c.getBBox().height)));
        this.titleOffset = a
    }, getChartSize: function () {
        var a = this.options.chart, b = this.renderToClone || this.renderTo;
        this.containerWidth = ib(b, "width");
        this.containerHeight = ib(b, "height");
        this.chartWidth = t(0, a.width || this.containerWidth || 600);
        this.chartHeight = t(0, o(a.height, this.containerHeight > 19 ? this.containerHeight : 400))
    }, cloneRenderTo: function (a) {
        var b = this.renderToClone, c = this.container;
        a ? b && (this.renderTo.appendChild(c), Oa(b), delete this.renderToClone) : (c &&
            c.parentNode === this.renderTo && this.renderTo.removeChild(c), this.renderToClone = b = this.renderTo.cloneNode(0), D(b, {position: "absolute", top: "-9999px", display: "block"}), v.body.appendChild(b), c && b.appendChild(c))
    }, getContainer: function () {
        var a, b = this.options.chart, c, d, e;
        this.renderTo = a = b.renderTo;
        e = "highcharts-" + tb++;
        if (da(a))this.renderTo = a = v.getElementById(a);
        a || la(13, !0);
        c = z(y(a, "data-highcharts-chart"));
        !isNaN(c) && Ja[c] && Ja[c].destroy();
        y(a, "data-highcharts-chart", this.index);
        a.innerHTML = "";
        a.offsetWidth ||
        this.cloneRenderTo();
        this.getChartSize();
        c = this.chartWidth;
        d = this.chartHeight;
        this.container = a = T(Ha, {className: "highcharts-container" + (b.className ? " " + b.className : ""), id: e}, r({position: "relative", overflow: "hidden", width: c + "px", height: d + "px", textAlign: "left", lineHeight: "normal", zIndex: 0, "-webkit-tap-highlight-color": "rgba(0,0,0,0)"}, b.style), this.renderToClone || a);
        this._cursor = a.style.cursor;
        this.renderer = b.forExport ? new va(a, c, d, !0) : new Xa(a, c, d);
        ba && this.renderer.create(this, a, c, d)
    }, getMargins: function () {
        var a =
            this.spacing, b, c = this.legend, d = this.margin, e = this.options.legend, f = o(e.margin, 10), g = e.x, h = e.y, i = e.align, j = e.verticalAlign, k = this.titleOffset;
        this.resetMargins();
        b = this.axisOffset;
        if (k && !s(d[0]))this.plotTop = t(this.plotTop, k + this.options.title.margin + a[0]);
        if (c.display && !e.floating)if (i === "right") {
            if (!s(d[1]))this.marginRight = t(this.marginRight, c.legendWidth - g + f + a[1])
        } else if (i === "left") {
            if (!s(d[3]))this.plotLeft = t(this.plotLeft, c.legendWidth + g + f + a[3])
        } else if (j === "top") {
            if (!s(d[0]))this.plotTop = t(this.plotTop,
                    c.legendHeight + h + f + a[0])
        } else if (j === "bottom" && !s(d[2]))this.marginBottom = t(this.marginBottom, c.legendHeight - h + f + a[2]);
        this.extraBottomMargin && (this.marginBottom += this.extraBottomMargin);
        this.extraTopMargin && (this.plotTop += this.extraTopMargin);
        this.hasCartesianSeries && n(this.axes, function (a) {
            a.getOffset()
        });
        s(d[3]) || (this.plotLeft += b[3]);
        s(d[0]) || (this.plotTop += b[0]);
        s(d[2]) || (this.marginBottom += b[2]);
        s(d[1]) || (this.marginRight += b[1]);
        this.setChartSize()
    }, reflow: function (a) {
        var b = this, c = b.options.chart,
            d = b.renderTo, e = c.width || ib(d, "width"), f = c.height || ib(d, "height"), c = a ? a.target : C, d = function () {
                if (b.container)b.setSize(e, f, !1), b.hasUserSize = null
            };
        if (!b.hasUserSize && e && f && (c === C || c === v)) {
            if (e !== b.containerWidth || f !== b.containerHeight)clearTimeout(b.reflowTimeout), a ? b.reflowTimeout = setTimeout(d, 100) : d();
            b.containerWidth = e;
            b.containerHeight = f
        }
    }, initReflow: function () {
        var a = this, b = function (b) {
            a.reflow(b)
        };
        F(C, "resize", b);
        F(a, "destroy", function () {
            X(C, "resize", b)
        })
    }, setSize: function (a, b, c) {
        var d = this, e,
            f, g;
        d.isResizing += 1;
        g = function () {
            d && A(d, "endResize", null, function () {
                d.isResizing -= 1
            })
        };
        Pa(c, d);
        d.oldChartHeight = d.chartHeight;
        d.oldChartWidth = d.chartWidth;
        if (s(a))d.chartWidth = e = t(0, w(a)), d.hasUserSize = !!e;
        if (s(b))d.chartHeight = f = t(0, w(b));
        (pa ? jb : D)(d.container, {width: e + "px", height: f + "px"}, pa);
        d.setChartSize(!0);
        d.renderer.setSize(e, f, c);
        d.maxTicks = null;
        n(d.axes, function (a) {
            a.isDirty = !0;
            a.setScale()
        });
        n(d.series, function (a) {
            a.isDirty = !0
        });
        d.isDirtyLegend = !0;
        d.isDirtyBox = !0;
        d.getMargins();
        d.redraw(c);
        d.oldChartHeight = null;
        A(d, "resize");
        pa === !1 ? g() : setTimeout(g, pa && pa.duration || 500)
    }, setChartSize: function (a) {
        var b = this.inverted, c = this.renderer, d = this.chartWidth, e = this.chartHeight, f = this.options.chart, g = this.spacing, h = this.clipOffset, i, j, k, l;
        this.plotLeft = i = w(this.plotLeft);
        this.plotTop = j = w(this.plotTop);
        this.plotWidth = k = t(0, w(d - i - this.marginRight));
        this.plotHeight = l = t(0, w(e - j - this.marginBottom));
        this.plotSizeX = b ? l : k;
        this.plotSizeY = b ? k : l;
        this.plotBorderWidth = f.plotBorderWidth || 0;
        this.spacingBox =
            c.spacingBox = {x: g[3], y: g[0], width: d - g[3] - g[1], height: e - g[0] - g[2]};
        this.plotBox = c.plotBox = {x: i, y: j, width: k, height: l};
        d = 2 * N(this.plotBorderWidth / 2);
        b = Ia(t(d, h[3]) / 2);
        c = Ia(t(d, h[0]) / 2);
        this.clipBox = {x: b, y: c, width: N(this.plotSizeX - t(d, h[1]) / 2 - b), height: N(this.plotSizeY - t(d, h[2]) / 2 - c)};
        a || n(this.axes, function (a) {
            a.setAxisSize();
            a.setAxisTranslation()
        })
    }, resetMargins: function () {
        var a = this.spacing, b = this.margin;
        this.plotTop = o(b[0], a[0]);
        this.marginRight = o(b[1], a[1]);
        this.marginBottom = o(b[2], a[2]);
        this.plotLeft =
            o(b[3], a[3]);
        this.axisOffset = [0, 0, 0, 0];
        this.clipOffset = [0, 0, 0, 0]
    }, drawChartBox: function () {
        var a = this.options.chart, b = this.renderer, c = this.chartWidth, d = this.chartHeight, e = this.chartBackground, f = this.plotBackground, g = this.plotBorder, h = this.plotBGImage, i = a.borderWidth || 0, j = a.backgroundColor, k = a.plotBackgroundColor, l = a.plotBackgroundImage, m = a.plotBorderWidth || 0, p, q = this.plotLeft, o = this.plotTop, n = this.plotWidth, t = this.plotHeight, s = this.plotBox, r = this.clipRect, w = this.clipBox;
        p = i + (a.shadow ? 8 : 0);
        if (i || j)if (e)e.animate(e.crisp(null,
            null, null, c - p, d - p)); else {
            e = {fill: j || Q};
            if (i)e.stroke = a.borderColor, e["stroke-width"] = i;
            this.chartBackground = b.rect(p / 2, p / 2, c - p, d - p, a.borderRadius, i).attr(e).add().shadow(a.shadow)
        }
        if (k)f ? f.animate(s) : this.plotBackground = b.rect(q, o, n, t, 0).attr({fill: k}).add().shadow(a.plotShadow);
        if (l)h ? h.animate(s) : this.plotBGImage = b.image(l, q, o, n, t).add();
        r ? r.animate({width: w.width, height: w.height}) : this.clipRect = b.clipRect(w);
        if (m)g ? g.animate(g.crisp(null, q, o, n, t)) : this.plotBorder = b.rect(q, o, n, t, 0, -m).attr({stroke: a.plotBorderColor,
            "stroke-width": m, zIndex: 1}).add();
        this.isDirtyBox = !1
    }, propFromSeries: function () {
        var a = this, b = a.options.chart, c, d = a.options.series, e, f;
        n(["inverted", "angular", "polar"], function (g) {
            c = L[b.type || b.defaultSeriesType];
            f = a[g] || b[g] || c && c.prototype[g];
            for (e = d && d.length; !f && e--;)(c = L[d[e].type]) && c.prototype[g] && (f = !0);
            a[g] = f
        })
    }, linkSeries: function () {
        var a = this, b = a.series;
        n(b, function (a) {
            a.linkedSeries.length = 0
        });
        n(b, function (b) {
            var d = b.options.linkedTo;
            if (da(d) && (d = d === ":previous" ? a.series[b.index - 1] : a.get(d)))d.linkedSeries.push(b),
                b.linkedParent = d
        })
    }, render: function () {
        var a = this, b = a.axes, c = a.renderer, d = a.options, e = d.labels, f = d.credits, g;
        a.setTitle();
        a.legend = new zb(a, d.legend);
        a.getStacks();
        n(b, function (a) {
            a.setScale()
        });
        a.getMargins();
        a.maxTicks = null;
        n(b, function (a) {
            a.setTickPositions(!0);
            a.setMaxTicks()
        });
        a.adjustTickAmounts();
        a.getMargins();
        a.drawChartBox();
        a.hasCartesianSeries && n(b, function (a) {
            a.render()
        });
        if (!a.seriesGroup)a.seriesGroup = c.g("series-group").attr({zIndex: 3}).add();
        n(a.series, function (a) {
            a.translate();
            a.setTooltipPoints();
            a.render()
        });
        e.items && n(e.items, function (b) {
            var d = r(e.style, b.style), f = z(d.left) + a.plotLeft, g = z(d.top) + a.plotTop + 12;
            delete d.left;
            delete d.top;
            c.text(b.html, f, g).attr({zIndex: 2}).css(d).add()
        });
        if (f.enabled && !a.credits)g = f.href, a.credits = c.text(f.text, 0, 0).on("click", function () {
            if (g)location.href = g
        }).attr({align: f.position.align, zIndex: 8}).css(f.style).add().align(f.position);
        a.hasRendered = !0
    }, destroy: function () {
        var a = this, b = a.axes, c = a.series, d = a.container, e, f = d && d.parentNode;
        A(a, "destroy");
        Ja[a.index] =
            u;
        a.renderTo.removeAttribute("data-highcharts-chart");
        X(a);
        for (e = b.length; e--;)b[e] = b[e].destroy();
        for (e = c.length; e--;)c[e] = c[e].destroy();
        n("title,subtitle,chartBackground,plotBackground,plotBGImage,plotBorder,seriesGroup,clipRect,credits,pointer,scroller,rangeSelector,legend,resetZoomButton,tooltip,renderer".split(","), function (b) {
            var c = a[b];
            c && c.destroy && (a[b] = c.destroy())
        });
        if (d)d.innerHTML = "", X(d), f && Oa(d);
        for (e in a)delete a[e]
    }, isReadyToRender: function () {
        var a = this;
        return!V && C == C.top && v.readyState !==
            "complete" || ba && !C.canvg ? (ba ? Mb.push(function () {
            a.firstRender()
        }, a.options.global.canvasToolsURL) : v.attachEvent("onreadystatechange", function () {
            v.detachEvent("onreadystatechange", a.firstRender);
            v.readyState === "complete" && a.firstRender()
        }), !1) : !0
    }, firstRender: function () {
        var a = this, b = a.options, c = a.callback;
        if (a.isReadyToRender())a.getContainer(), A(a, "init"), a.resetMargins(), a.setChartSize(), a.propFromSeries(), a.getAxes(), n(b.series || [], function (b) {
            a.initSeries(b)
        }), a.linkSeries(), A(a, "beforeRender"),
            a.pointer = new Za(a, b), a.render(), a.renderer.draw(), c && c.apply(a, [a]), n(a.callbacks, function (b) {
            b.apply(a, [a])
        }), a.cloneRenderTo(!0), A(a, "load")
    }, splashArray: function (a, b) {
        var c = b[a], c = S(c) ? c : [c, c, c, c];
        return[o(b[a + "Top"], c[0]), o(b[a + "Right"], c[1]), o(b[a + "Bottom"], c[2]), o(b[a + "Left"], c[3])]
    }};
    eb.prototype.callbacks = [];
    var xb = Highcharts.CenteredSeriesMixin = {getCenter: function () {
        var a = this.options, b = this.chart, c = 2 * (a.slicedOffset || 0), d, e = b.plotWidth - 2 * c, f = b.plotHeight - 2 * c, b = a.center, a = [o(b[0], "50%"),
            o(b[1], "50%"), a.size || "100%", a.innerSize || 0], g = I(e, f), h;
        return Sa(a, function (a, b) {
            h = /%$/.test(a);
            d = b < 2 || b === 2 && h;
            return(h ? [e, f, g, g][b] * z(a) / 100 : a) + (d ? c : 0)
        })
    }}, Ka = function () {
    };
    Ka.prototype = {init: function (a, b, c) {
        this.series = a;
        this.applyOptions(b, c);
        this.pointAttr = {};
        if (a.options.colorByPoint && (b = a.options.colors || a.chart.options.colors, this.color = this.color || b[a.colorCounter++], a.colorCounter === b.length))a.colorCounter = 0;
        a.chart.pointCount++;
        return this
    }, applyOptions: function (a, b) {
        var c = this.series,
            d = c.pointValKey, a = Ka.prototype.optionsToObject.call(this, a);
        r(this, a);
        this.options = this.options ? r(this.options, a) : a;
        if (d)this.y = this[d];
        if (this.x === u && c)this.x = b === u ? c.autoIncrement() : b;
        return this
    }, optionsToObject: function (a) {
        var b = {}, c = this.series, d = c.pointArrayMap || ["y"], e = d.length, f = 0, g = 0;
        if (typeof a === "number" || a === null)b[d[0]] = a; else if (La(a)) {
            if (a.length > e) {
                c = typeof a[0];
                if (c === "string")b.name = a[0]; else if (c === "number")b.x = a[0];
                f++
            }
            for (; g < e;)b[d[g++]] = a[f++]
        } else if (typeof a === "object") {
            b =
                a;
            if (a.dataLabels)c._hasPointLabels = !0;
            if (a.marker)c._hasPointMarkers = !0
        }
        return b
    }, destroy: function () {
        var a = this.series.chart, b = a.hoverPoints, c;
        a.pointCount--;
        if (b && (this.setState(), fa(b, this), !b.length))a.hoverPoints = null;
        if (this === a.hoverPoint)this.onMouseOut();
        if (this.graphic || this.dataLabel)X(this), this.destroyElements();
        this.legendItem && a.legend.destroyItem(this);
        for (c in this)this[c] = null
    }, destroyElements: function () {
        for (var a = "graphic,dataLabel,dataLabelUpper,group,connector,shadowGroup".split(","),
                 b, c = 6; c--;)b = a[c], this[b] && (this[b] = this[b].destroy())
    }, getLabelConfig: function () {
        return{x: this.category, y: this.y, key: this.name || this.category, series: this.series, point: this, percentage: this.percentage, total: this.total || this.stackTotal}
    }, select: function (a, b) {
        var c = this, d = c.series, e = d.chart, a = o(a, !c.selected);
        c.firePointEvent(a ? "select" : "unselect", {accumulate: b}, function () {
            c.selected = c.options.selected = a;
            d.options.data[ta(c, d.data)] = c.options;
            c.setState(a && "select");
            b || n(e.getSelectedPoints(), function (a) {
                if (a.selected &&
                    a !== c)a.selected = a.options.selected = !1, d.options.data[ta(a, d.data)] = a.options, a.setState(""), a.firePointEvent("unselect")
            })
        })
    }, onMouseOver: function (a) {
        var b = this.series, c = b.chart, d = c.tooltip, e = c.hoverPoint;
        if (e && e !== this)e.onMouseOut();
        this.firePointEvent("mouseOver");
        d && (!d.shared || b.noSharedTooltip) && d.refresh(this, a);
        this.setState("hover");
        c.hoverPoint = this
    }, onMouseOut: function () {
        var a = this.series.chart, b = a.hoverPoints;
        if (!b || ta(this, b) === -1)this.firePointEvent("mouseOut"), this.setState(), a.hoverPoint =
            null
    }, tooltipFormatter: function (a) {
        var b = this.series, c = b.tooltipOptions, d = o(c.valueDecimals, ""), e = c.valuePrefix || "", f = c.valueSuffix || "";
        n(b.pointArrayMap || ["y"], function (b) {
            b = "{point." + b;
            if (e || f)a = a.replace(b + "}", e + b + "}" + f);
            a = a.replace(b + "}", b + ":,." + d + "f}")
        });
        return Ga(a, {point: this, series: this.series})
    }, firePointEvent: function (a, b, c) {
        var d = this, e = this.series.options;
        (e.point.events[a] || d.options && d.options.events && d.options.events[a]) && this.importEvents();
        a === "click" && e.allowPointSelect && (c = function (a) {
            d.select(null,
                    a.ctrlKey || a.metaKey || a.shiftKey)
        });
        A(this, a, b, c)
    }, importEvents: function () {
        if (!this.hasImportedEvents) {
            var a = x(this.series.options.point, this.options).events, b;
            this.events = a;
            for (b in a)F(this, b, a[b]);
            this.hasImportedEvents = !0
        }
    }, setState: function (a, b) {
        var c = this.plotX, d = this.plotY, e = this.series, f = e.options.states, g = Y[e.type].marker && e.options.marker, h = g && !g.enabled, i = g && g.states[a], j = i && i.enabled === !1, k = e.stateMarkerGraphic, l = this.marker || {}, m = e.chart, p = this.pointAttr, a = a || "", b = b && k;
        if (!(a === this.state && !b || this.selected && a !== "select" || f[a] && f[a].enabled === !1 || a && (j || h && !i.enabled) || a && l.states && l.states[a] && l.states[a].enabled === !1)) {
            if (this.graphic)f = g && this.graphic.symbolName && p[a].r, this.graphic.attr(x(p[a], f ? {x: c - f, y: d - f, width: 2 * f, height: 2 * f} : {})); else {
                if (a && i)if (f = i.radius, l = l.symbol || e.symbol, k && k.currentSymbol !== l && (k = k.destroy()), k)k[b ? "animate" : "attr"]({x: c - f, y: d - f}); else e.stateMarkerGraphic = k = m.renderer.symbol(l, c - f, d - f, 2 * f, 2 * f).attr(p[a]).add(e.markerGroup), k.currentSymbol = l;
                if (k)k[a &&
                    m.isInsidePlot(c, d, m.inverted) ? "show" : "hide"]()
            }
            this.state = a
        }
    }};
    var O = function () {
    };
    O.prototype = {isCartesian: !0, type: "line", pointClass: Ka, sorted: !0, requireSorting: !0, pointAttrToOptions: {stroke: "lineColor", "stroke-width": "lineWidth", fill: "fillColor", r: "radius"}, axisTypes: ["xAxis", "yAxis"], colorCounter: 0, parallelArrays: ["x", "y"], init: function (a, b) {
        var c = this, d, e, f = a.series, g = function (a, b) {
            return o(a.options.index, a._i) - o(b.options.index, b._i)
        };
        c.chart = a;
        c.options = b = c.setOptions(b);
        c.linkedSeries = [];
        c.bindAxes();
        r(c, {name: b.name, state: "", pointAttr: {}, visible: b.visible !== !1, selected: b.selected === !0});
        if (ba)b.animation = !1;
        e = b.events;
        for (d in e)F(c, d, e[d]);
        if (e && e.click || b.point && b.point.events && b.point.events.click || b.allowPointSelect)a.runTrackerClick = !0;
        c.getColor();
        c.getSymbol();
        n(c.parallelArrays, function (a) {
            c[a + "Data"] = []
        });
        c.setData(b.data, !1);
        if (c.isCartesian)a.hasCartesianSeries = !0;
        f.push(c);
        c._i = f.length - 1;
        nb(f, g);
        this.yAxis && nb(this.yAxis.series, g);
        n(f, function (a, b) {
            a.index = b;
            a.name =
                a.name || "Series " + (b + 1)
        })
    }, bindAxes: function () {
        var a = this, b = a.options, c = a.chart, d;
        n(a.axisTypes || [], function (e) {
            n(c[e], function (c) {
                d = c.options;
                if (b[e] === d.index || b[e] !== u && b[e] === d.id || b[e] === u && d.index === 0)c.series.push(a), a[e] = c, c.isDirty = !0
            });
            !a[e] && a.optionalAxis !== e && la(18, !0)
        })
    }, updateParallelArrays: function (a, b) {
        var c = a.series, d = arguments;
        n(c.parallelArrays, typeof b === "number" ? function (d) {
            var f = d === "y" && c.toYData ? c.toYData(a) : a[d];
            c[d + "Data"][b] = f
        } : function (a) {
            Array.prototype[b].apply(c[a +
                "Data"], Array.prototype.slice.call(d, 2))
        })
    }, autoIncrement: function () {
        var a = this.options, b = this.xIncrement, b = o(b, a.pointStart, 0);
        this.pointInterval = o(this.pointInterval, a.pointInterval, 1);
        this.xIncrement = b + this.pointInterval;
        return b
    }, getSegments: function () {
        var a = -1, b = [], c, d = this.points, e = d.length;
        if (e)if (this.options.connectNulls) {
            for (c = e; c--;)d[c].y === null && d.splice(c, 1);
            d.length && (b = [d])
        } else n(d, function (c, g) {
            c.y === null ? (g > a + 1 && b.push(d.slice(a + 1, g)), a = g) : g === e - 1 && b.push(d.slice(a + 1, g + 1))
        });
        this.segments =
            b
    }, setOptions: function (a) {
        var b = this.chart, c = b.options.plotOptions, b = b.userOptions || {}, d = b.plotOptions || {}, e = c[this.type];
        this.userOptions = a;
        c = x(e, c.series, a);
        this.tooltipOptions = x(G.tooltip, G.plotOptions[this.type].tooltip, b.tooltip, d.series && d.series.tooltip, d[this.type] && d[this.type].tooltip, a.tooltip);
        e.marker === null && delete c.marker;
        return c
    }, getColor: function () {
        var a = this.options, b = this.userOptions, c = this.chart.options.colors, d = this.chart.counters, e;
        e = a.color || Y[this.type].color;
        if (!e && !a.colorByPoint)s(b._colorIndex) ?
            a = b._colorIndex : (b._colorIndex = d.color, a = d.color++), e = c[a];
        this.color = e;
        d.wrapColor(c.length)
    }, getSymbol: function () {
        var a = this.userOptions, b = this.options.marker, c = this.chart, d = c.options.symbols, c = c.counters;
        this.symbol = b.symbol;
        if (!this.symbol)s(a._symbolIndex) ? a = a._symbolIndex : (a._symbolIndex = c.symbol, a = c.symbol++), this.symbol = d[a];
        if (/^url/.test(this.symbol))b.radius = 0;
        c.wrapSymbol(d.length)
    }, drawLegendSymbol: R.drawLineMarker, setData: function (a, b) {
        var c = this, d = c.points, e = c.options, f = c.chart, g = null,
            h = c.xAxis, i = h && !!h.categories, j;
        c.xIncrement = null;
        c.pointRange = i ? 1 : e.pointRange;
        c.colorCounter = 0;
        var a = a || [], k = a.length;
        j = e.turboThreshold;
        var l = this.xData, m = this.yData, p = c.pointArrayMap, p = p && p.length;
        n(this.parallelArrays, function (a) {
            c[a + "Data"].length = 0
        });
        if (j && k > j) {
            for (j = 0; g === null && j < k;)g = a[j], j++;
            if (xa(g)) {
                i = o(e.pointStart, 0);
                e = o(e.pointInterval, 1);
                for (j = 0; j < k; j++)l[j] = i, m[j] = a[j], i += e;
                c.xIncrement = i
            } else if (La(g))if (p)for (j = 0; j < k; j++)e = a[j], l[j] = e[0], m[j] = e.slice(1, p + 1); else for (j = 0; j < k; j++)e =
                a[j], l[j] = e[0], m[j] = e[1]; else la(12)
        } else for (j = 0; j < k; j++)if (a[j] !== u && (e = {series: c}, c.pointClass.prototype.applyOptions.apply(e, [a[j]]), c.updateParallelArrays(e, j), i && e.name))h.names[e.x] = e.name;
        da(m[0]) && la(14, !0);
        c.data = [];
        c.options.data = a;
        for (j = d && d.length || 0; j--;)d[j] && d[j].destroy && d[j].destroy();
        if (h)h.minRange = h.userMinRange;
        c.isDirty = c.isDirtyData = f.isDirtyBox = !0;
        o(b, !0) && f.redraw(!1)
    }, processData: function (a) {
        var b = this.xData, c = this.yData, d = b.length, e;
        e = 0;
        var f, g, h = this.xAxis, i = this.options,
            j = i.cropThreshold, k = this.isCartesian;
        if (k && !this.isDirty && !h.isDirty && !this.yAxis.isDirty && !a)return!1;
        if (k && this.sorted && (!j || d > j || this.forceCrop))if (a = h.min, h = h.max, b[d - 1] < a || b[0] > h)b = [], c = []; else if (b[0] < a || b[d - 1] > h)e = this.cropData(this.xData, this.yData, a, h), b = e.xData, c = e.yData, e = e.start, f = !0;
        for (h = b.length - 1; h >= 0; h--)d = b[h] - b[h - 1], d > 0 && (g === u || d < g) ? g = d : d < 0 && this.requireSorting && la(15);
        this.cropped = f;
        this.cropStart = e;
        this.processedXData = b;
        this.processedYData = c;
        if (i.pointRange === null)this.pointRange =
            g || 1;
        this.closestPointRange = g
    }, cropData: function (a, b, c, d) {
        var e = a.length, f = 0, g = e, h = o(this.cropShoulder, 1), i;
        for (i = 0; i < e; i++)if (a[i] >= c) {
            f = t(0, i - h);
            break
        }
        for (; i < e; i++)if (a[i] > d) {
            g = i + h;
            break
        }
        return{xData: a.slice(f, g), yData: b.slice(f, g), start: f, end: g}
    }, generatePoints: function () {
        var a = this.options.data, b = this.data, c, d = this.processedXData, e = this.processedYData, f = this.pointClass, g = d.length, h = this.cropStart || 0, i, j = this.hasGroupedData, k, l = [], m;
        if (!b && !j)b = [], b.length = a.length, b = this.data = b;
        for (m = 0; m < g; m++)i =
            h + m, j ? l[m] = (new f).init(this, [d[m]].concat(ka(e[m]))) : (b[i] ? k = b[i] : a[i] !== u && (b[i] = k = (new f).init(this, a[i], d[m])), l[m] = k);
        if (b && (g !== (c = b.length) || j))for (m = 0; m < c; m++)if (m === h && !j && (m += g), b[m])b[m].destroyElements(), b[m].plotX = u;
        this.data = b;
        this.points = l
    }, setStackedPoints: function () {
        if (this.options.stacking && !(this.visible !== !0 && this.chart.options.chart.ignoreHiddenSeries !== !1)) {
            var a = this.processedXData, b = this.processedYData, c = [], d = b.length, e = this.options, f = e.threshold, g = e.stack, e = e.stacking, h = this.stackKey,
                i = "-" + h, j = this.negStacks, k = this.yAxis, l = k.stacks, m = k.oldStacks, p, q, o, n, s;
            for (o = 0; o < d; o++) {
                n = a[o];
                s = b[o];
                q = (p = j && s < f) ? i : h;
                l[q] || (l[q] = {});
                if (!l[q][n])m[q] && m[q][n] ? (l[q][n] = m[q][n], l[q][n].total = null) : l[q][n] = new Gb(k, k.options.stackLabels, p, n, g, e);
                q = l[q][n];
                q.points[this.index] = [q.cum || 0];
                e === "percent" ? (p = p ? h : i, j && l[p] && l[p][n] ? (p = l[p][n], q.total = p.total = t(p.total, q.total) + M(s) || 0) : q.total += M(s) || 0) : q.total += s || 0;
                q.cum = (q.cum || 0) + (s || 0);
                q.points[this.index].push(q.cum);
                c[o] = q.cum
            }
            if (e === "percent")k.usePercentage = !0;
            this.stackedYData = c;
            k.oldStacks = {}
        }
    }, setPercentStacks: function () {
        var a = this, b = a.stackKey, c = a.yAxis.stacks;
        n([b, "-" + b], function (b) {
            var d;
            for (var e = a.xData.length, f, g; e--;)if (f = a.xData[e], d = (g = c[b] && c[b][f]) && g.points[a.index], f = d)g = g.total ? 100 / g.total : 0, f[0] = ha(f[0] * g), f[1] = ha(f[1] * g), a.stackedYData[e] = f[1]
        })
    }, getExtremes: function (a) {
        var b = this.yAxis, c = this.processedXData, d, e = [], f = 0;
        d = this.xAxis.getExtremes();
        var g = d.min, h = d.max, i, j, k, l, a = a || this.stackedYData || this.processedYData;
        d = a.length;
        for (l =
                 0; l < d; l++)if (j = c[l], k = a[l], i = k !== null && k !== u && (!b.isLog || k.length || k > 0), j = this.getExtremesFromAll || this.cropped || (c[l + 1] || j) >= g && (c[l - 1] || j) <= h, i && j)if (i = k.length)for (; i--;)k[i] !== null && (e[f++] = k[i]); else e[f++] = k;
        this.dataMin = o(void 0, Ma(e));
        this.dataMax = o(void 0, Aa(e))
    }, translate: function () {
        this.processedXData || this.processData();
        this.generatePoints();
        for (var a = this.options, b = a.stacking, c = this.xAxis, d = c.categories, e = this.yAxis, f = this.points, g = f.length, h = !!this.modifyValue, i = a.pointPlacement, j = i ===
            "between" || xa(i), k = a.threshold, a = 0; a < g; a++) {
            var l = f[a], m = l.x, p = l.y, q = l.low, n = b && e.stacks[(this.negStacks && p < k ? "-" : "") + this.stackKey];
            if (e.isLog && p <= 0)l.y = p = null;
            l.plotX = c.translate(m, 0, 0, 0, 1, i, this.type === "flags");
            if (b && this.visible && n && n[m])n = n[m], p = n.points[this.index], q = p[0], p = p[1], q === 0 && (q = o(k, e.min)), e.isLog && q <= 0 && (q = null), l.total = l.stackTotal = n.total, l.percentage = b === "percent" && l.y / n.total * 100, l.stackY = p, n.setOffset(this.pointXOffset || 0, this.barW || 0);
            l.yBottom = s(q) ? e.translate(q, 0, 1, 0, 1) :
                null;
            h && (p = this.modifyValue(p, l));
            l.plotY = typeof p === "number" && p !== Infinity ? e.translate(p, 0, 1, 0, 1) : u;
            l.clientX = j ? c.translate(m, 0, 0, 0, 1) : l.plotX;
            l.negative = l.y < (k || 0);
            l.category = d && d[l.x] !== u ? d[l.x] : l.x
        }
        this.getSegments()
    }, setTooltipPoints: function (a) {
        var b = [], c, d, e = this.xAxis, f = e && e.getExtremes(), g = e ? e.tooltipLen || e.len : this.chart.plotSizeX, h, i, j = [];
        if (this.options.enableMouseTracking !== !1) {
            if (a)this.tooltipPoints = null;
            n(this.segments || this.points, function (a) {
                b = b.concat(a)
            });
            e && e.reversed && (b = b.reverse());
            this.orderTooltipPoints && this.orderTooltipPoints(b);
            a = b.length;
            for (i = 0; i < a; i++)if (e = b[i], c = e.x, c >= f.min && c <= f.max) {
                h = b[i + 1];
                c = d === u ? 0 : d + 1;
                for (d = b[i + 1] ? I(t(0, N((e.clientX + (h ? h.wrappedClientX || h.clientX : g)) / 2)), g) : g; c >= 0 && c <= d;)j[c++] = e
            }
            this.tooltipPoints = j
        }
    }, tooltipHeaderFormatter: function (a) {
        var b = this.tooltipOptions, c = b.dateTimeLabelFormats, d = b.xDateFormat || c.year, e = this.xAxis, f = e && e.options.type === "datetime", b = b.headerFormat, e = e && e.closestPointRange, g;
        if (f && !d)if (e)for (g in E) {
            if (E[g] >= e) {
                d = c[g];
                break
            }
        } else d = c.day;
        f && d && xa(a.key) && (b = b.replace("{point.key}", "{point.key:" + d + "}"));
        return Ga(b, {point: a, series: this})
    }, onMouseOver: function () {
        var a = this.chart, b = a.hoverSeries;
        if (b && b !== this)b.onMouseOut();
        this.options.events.mouseOver && A(this, "mouseOver");
        this.setState("hover");
        a.hoverSeries = this
    }, onMouseOut: function () {
        var a = this.options, b = this.chart, c = b.tooltip, d = b.hoverPoint;
        if (d)d.onMouseOut();
        this && a.events.mouseOut && A(this, "mouseOut");
        c && !a.stickyTracking && (!c.shared || this.noSharedTooltip) &&
        c.hide();
        this.setState();
        b.hoverSeries = null
    }, animate: function (a) {
        var b = this, c = b.chart, d = c.renderer, e;
        e = b.options.animation;
        var f = c.clipBox, g = c.inverted, h;
        if (e && !S(e))e = Y[b.type].animation;
        h = "_sharedClip" + e.duration + e.easing;
        if (a)a = c[h], e = c[h + "m"], a || (c[h] = a = d.clipRect(r(f, {width: 0})), c[h + "m"] = e = d.clipRect(-99, g ? -c.plotLeft : -c.plotTop, 99, g ? c.chartWidth : c.chartHeight)), b.group.clip(a), b.markerGroup.clip(e), b.sharedClipKey = h; else {
            if (a = c[h])a.animate({width: c.plotSizeX}, e), c[h + "m"].animate({width: c.plotSizeX +
                99}, e);
            b.animate = null;
            b.animationTimeout = setTimeout(function () {
                b.afterAnimate()
            }, e.duration)
        }
    }, afterAnimate: function () {
        var a = this.chart, b = this.sharedClipKey, c = this.group;
        c && this.options.clip !== !1 && (c.clip(a.clipRect), this.markerGroup.clip());
        setTimeout(function () {
            b && a[b] && (a[b] = a[b].destroy(), a[b + "m"] = a[b + "m"].destroy())
        }, 100)
    }, drawPoints: function () {
        var a, b = this.points, c = this.chart, d, e, f, g, h, i, j, k, l = this.options.marker, m = this.pointAttr[""], p, q = this.markerGroup;
        if (l.enabled || this._hasPointMarkers)for (f =
                                                        b.length; f--;)if (g = b[f], d = N(g.plotX), e = g.plotY, k = g.graphic, i = g.marker || {}, a = l.enabled && i.enabled === u || i.enabled, p = c.isInsidePlot(w(d), e, c.inverted), a && e !== u && !isNaN(e) && g.y !== null)if (a = g.pointAttr[g.selected ? "select" : ""] || m, h = a.r, i = o(i.symbol, this.symbol), j = i.indexOf("url") === 0, k)k.attr({visibility: p ? V ? "inherit" : "visible" : "hidden"}).animate(r({x: d - h, y: e - h}, k.symbolName ? {width: 2 * h, height: 2 * h} : {})); else {
            if (p && (h > 0 || j))g.graphic = c.renderer.symbol(i, d - h, e - h, 2 * h, 2 * h).attr(a).add(q)
        } else if (k)g.graphic =
            k.destroy()
    }, convertAttribs: function (a, b, c, d) {
        var e = this.pointAttrToOptions, f, g, h = {}, a = a || {}, b = b || {}, c = c || {}, d = d || {};
        for (f in e)g = e[f], h[f] = o(a[g], b[f], c[f], d[f]);
        return h
    }, getAttribs: function () {
        var a = this, b = a.options, c = Y[a.type].marker ? b.marker : b, d = c.states, e = d.hover, f, g = a.color;
        f = {stroke: g, fill: g};
        var h = a.points || [], i, j = [], k, l = a.pointAttrToOptions;
        i = b.turboThreshold;
        var m = b.negativeColor, p = c.lineColor, q;
        b.marker ? (e.radius = e.radius || c.radius + 2, e.lineWidth = e.lineWidth || c.lineWidth + 1) : e.color = e.color ||
            ua(e.color || g).brighten(e.brightness).get();
        j[""] = a.convertAttribs(c, f);
        n(["hover", "select"], function (b) {
            j[b] = a.convertAttribs(d[b], j[""])
        });
        a.pointAttr = j;
        g = h.length;
        if (!i || g < i)for (; g--;) {
            i = h[g];
            if ((c = i.options && i.options.marker || i.options) && c.enabled === !1)c.radius = 0;
            if (i.negative && m)i.color = i.fillColor = m;
            f = b.colorByPoint || i.color;
            if (i.options)for (q in l)s(c[l[q]]) && (f = !0);
            if (f) {
                c = c || {};
                k = [];
                d = c.states || {};
                f = d.hover = d.hover || {};
                if (!b.marker)f.color = f.color || e.color || ua(i.color).brighten(f.brightness ||
                    e.brightness).get();
                k[""] = a.convertAttribs(r({color: i.color, fillColor: i.color, lineColor: p === null ? i.color : u}, c), j[""]);
                k.hover = a.convertAttribs(d.hover, j.hover, k[""]);
                k.select = a.convertAttribs(d.select, j.select, k[""])
            } else k = j;
            i.pointAttr = k
        }
    }, destroy: function () {
        var a = this, b = a.chart, c = /AppleWebKit\/533/.test(sa), d, e, f = a.data || [], g, h, i;
        A(a, "destroy");
        X(a);
        n(a.axisTypes || [], function (b) {
            if (i = a[b])fa(i.series, a), i.isDirty = i.forceRedraw = !0
        });
        a.legendItem && a.chart.legend.destroyItem(a);
        for (e = f.length; e--;)(g =
            f[e]) && g.destroy && g.destroy();
        a.points = null;
        clearTimeout(a.animationTimeout);
        n("area,graph,dataLabelsGroup,group,markerGroup,tracker,graphNeg,areaNeg,posClip,negClip".split(","), function (b) {
            a[b] && (d = c && b === "group" ? "hide" : "destroy", a[b][d]())
        });
        if (b.hoverSeries === a)b.hoverSeries = null;
        fa(b.series, a);
        for (h in a)delete a[h]
    }, getSegmentPath: function (a) {
        var b = this, c = [], d = b.options.step;
        n(a, function (e, f) {
            var g = e.plotX, h = e.plotY, i;
            b.getPointSpline ? c.push.apply(c, b.getPointSpline(a, e, f)) : (c.push(f ? "L" : "M"),
                d && f && (i = a[f - 1], d === "right" ? c.push(i.plotX, h) : d === "center" ? c.push((i.plotX + g) / 2, i.plotY, (i.plotX + g) / 2, h) : c.push(g, i.plotY)), c.push(e.plotX, e.plotY))
        });
        return c
    }, getGraphPath: function () {
        var a = this, b = [], c, d = [];
        n(a.segments, function (e) {
            c = a.getSegmentPath(e);
            e.length > 1 ? b = b.concat(c) : d.push(e[0])
        });
        a.singlePoints = d;
        return a.graphPath = b
    }, drawGraph: function () {
        var a = this, b = this.options, c = [
            ["graph", b.lineColor || this.color]
        ], d = b.lineWidth, e = b.dashStyle, f = b.linecap !== "square", g = this.getGraphPath(), h = b.negativeColor;
        h && c.push(["graphNeg", h]);
        n(c, function (c, h) {
            var k = c[0], l = a[k];
            if (l)Ya(l), l.animate({d: g}); else if (d && g.length)l = {stroke: c[1], "stroke-width": d, zIndex: 1}, e ? l.dashstyle = e : f && (l["stroke-linecap"] = l["stroke-linejoin"] = "round"), a[k] = a.chart.renderer.path(g).attr(l).add(a.group).shadow(!h && b.shadow)
        })
    }, clipNeg: function () {
        var a = this.options, b = this.chart, c = b.renderer, d = a.negativeColor || a.negativeFillColor, e, f = this.graph, g = this.area, h = this.posClip, i = this.negClip;
        e = b.chartWidth;
        var j = b.chartHeight, k = t(e, j),
            l = this.yAxis;
        if (d && (f || g)) {
            d = w(l.toPixels(a.threshold || 0, !0));
            d < 0 && (k -= d);
            a = {x: 0, y: 0, width: k, height: d};
            k = {x: 0, y: d, width: k, height: k};
            if (b.inverted)a.height = k.y = b.plotWidth - d, c.isVML && (a = {x: b.plotWidth - d - b.plotLeft, y: 0, width: e, height: j}, k = {x: d + b.plotLeft - e, y: 0, width: b.plotLeft + d, height: e});
            l.reversed ? (b = k, e = a) : (b = a, e = k);
            h ? (h.animate(b), i.animate(e)) : (this.posClip = h = c.clipRect(b), this.negClip = i = c.clipRect(e), f && this.graphNeg && (f.clip(h), this.graphNeg.clip(i)), g && (g.clip(h), this.areaNeg.clip(i)))
        }
    }, invertGroups: function () {
        function a() {
            var a =
            {width: b.yAxis.len, height: b.xAxis.len};
            n(["group", "markerGroup"], function (c) {
                b[c] && b[c].attr(a).invert()
            })
        }

        var b = this, c = b.chart;
        if (b.xAxis)F(c, "resize", a), F(b, "destroy", function () {
            X(c, "resize", a)
        }), a(), b.invertGroups = a
    }, plotGroup: function (a, b, c, d, e) {
        var f = this[a], g = !f;
        g && (this[a] = f = this.chart.renderer.g(b).attr({visibility: c, zIndex: d || 0.1}).add(e));
        f[g ? "attr" : "animate"](this.getPlotBox());
        return f
    }, getPlotBox: function () {
        return{translateX: this.xAxis ? this.xAxis.left : this.chart.plotLeft, translateY: this.yAxis ?
            this.yAxis.top : this.chart.plotTop, scaleX: 1, scaleY: 1}
    }, render: function () {
        var a = this.chart, b, c = this.options, d = c.animation && !!this.animate && a.renderer.isSVG, e = this.visible ? "visible" : "hidden", f = c.zIndex, g = this.hasRendered, h = a.seriesGroup;
        b = this.plotGroup("group", "series", e, f, h);
        this.markerGroup = this.plotGroup("markerGroup", "markers", e, f, h);
        d && this.animate(!0);
        this.getAttribs();
        b.inverted = this.isCartesian ? a.inverted : !1;
        this.drawGraph && (this.drawGraph(), this.clipNeg());
        this.drawDataLabels && this.drawDataLabels();
        this.visible && this.drawPoints();
        this.options.enableMouseTracking !== !1 && this.drawTracker();
        a.inverted && this.invertGroups();
        c.clip !== !1 && !this.sharedClipKey && !g && b.clip(a.clipRect);
        d ? this.animate() : g || this.afterAnimate();
        this.isDirty = this.isDirtyData = !1;
        this.hasRendered = !0
    }, redraw: function () {
        var a = this.chart, b = this.isDirtyData, c = this.group, d = this.xAxis, e = this.yAxis;
        c && (a.inverted && c.attr({width: a.plotWidth, height: a.plotHeight}), c.animate({translateX: o(d && d.left, a.plotLeft), translateY: o(e && e.top, a.plotTop)}));
        this.translate();
        this.setTooltipPoints(!0);
        this.render();
        b && A(this, "updatedData")
    }, setState: function (a) {
        var b = this.options, c = this.graph, d = this.graphNeg, e = b.states, b = b.lineWidth, a = a || "";
        if (this.state !== a)this.state = a, e[a] && e[a].enabled === !1 || (a && (b = e[a].lineWidth || b + 1), c && !c.dashstyle && (a = {"stroke-width": b}, c.attr(a), d && d.attr(a)))
    }, setVisible: function (a, b) {
        var c = this, d = c.chart, e = c.legendItem, f, g = d.options.chart.ignoreHiddenSeries, h = c.visible;
        f = (c.visible = a = c.userOptions.visible = a === u ? !h : a) ? "show" :
            "hide";
        n(["group", "dataLabelsGroup", "markerGroup", "tracker"], function (a) {
            if (c[a])c[a][f]()
        });
        if (d.hoverSeries === c)c.onMouseOut();
        e && d.legend.colorizeItem(c, a);
        c.isDirty = !0;
        c.options.stacking && n(d.series, function (a) {
            if (a.options.stacking && a.visible)a.isDirty = !0
        });
        n(c.linkedSeries, function (b) {
            b.setVisible(a, !1)
        });
        if (g)d.isDirtyBox = !0;
        b !== !1 && d.redraw();
        A(c, f)
    }, show: function () {
        this.setVisible(!0)
    }, hide: function () {
        this.setVisible(!1)
    }, select: function (a) {
        this.selected = a = a === u ? !this.selected : a;
        if (this.checkbox)this.checkbox.checked =
            a;
        A(this, a ? "select" : "unselect")
    }, drawTracker: J.drawTrackerGraph};
    r(eb.prototype, {addSeries: function (a, b, c) {
        var d, e = this;
        a && (b = o(b, !0), A(e, "addSeries", {options: a}, function () {
            d = e.initSeries(a);
            e.isDirtyLegend = !0;
            e.linkSeries();
            b && e.redraw(c)
        }));
        return d
    }, addAxis: function (a, b, c, d) {
        var e = b ? "xAxis" : "yAxis", f = this.options;
        new ra(this, x(a, {index: this[e].length, isX: b}));
        f[e] = ka(f[e] || {});
        f[e].push(a);
        o(c, !0) && this.redraw(d)
    }, showLoading: function (a) {
        var b = this.options, c = this.loadingDiv, d = b.loading;
        if (!c)this.loadingDiv =
            c = T(Ha, {className: "highcharts-loading"}, r(d.style, {zIndex: 10, display: Q}), this.container), this.loadingSpan = T("span", null, d.labelStyle, c);
        this.loadingSpan.innerHTML = a || b.lang.loading;
        if (!this.loadingShown)D(c, {opacity: 0, display: "", left: this.plotLeft + "px", top: this.plotTop + "px", width: this.plotWidth + "px", height: this.plotHeight + "px"}), jb(c, {opacity: d.style.opacity}, {duration: d.showDuration || 0}), this.loadingShown = !0
    }, hideLoading: function () {
        var a = this.options, b = this.loadingDiv;
        b && jb(b, {opacity: 0}, {duration: a.loading.hideDuration ||
            100, complete: function () {
            D(b, {display: Q})
        }});
        this.loadingShown = !1
    }});
    r(Ka.prototype, {update: function (a, b, c) {
        var d = this, e = d.series, f = d.graphic, g, h = e.data, i = e.chart, j = e.options, b = o(b, !0);
        d.firePointEvent("update", {options: a}, function () {
            d.applyOptions(a);
            if (S(a)) {
                e.getAttribs();
                if (f)a && a.marker && a.marker.symbol ? d.graphic = f.destroy() : f.attr(d.pointAttr[d.state || ""]);
                if (a && a.dataLabels && d.dataLabel)d.dataLabel = d.dataLabel.destroy()
            }
            g = ta(d, h);
            e.updateParallelArrays(d, g);
            j.data[g] = d.options;
            e.isDirty = e.isDirtyData = !0;
            if (!e.fixedBox && e.hasCartesianSeries)i.isDirtyBox = !0;
            j.legendType === "point" && i.legend.destroyItem(d);
            b && i.redraw(c)
        })
    }, remove: function (a, b) {
        var c = this, d = c.series, e = d.points, f = d.chart, g, h = d.data;
        Pa(b, f);
        a = o(a, !0);
        c.firePointEvent("remove", null, function () {
            g = ta(c, h);
            h.length === e.length && e.splice(g, 1);
            h.splice(g, 1);
            d.options.data.splice(g, 1);
            d.updateParallelArrays(c, "splice", g, 1);
            c.destroy();
            d.isDirty = !0;
            d.isDirtyData = !0;
            a && f.redraw()
        })
    }});
    r(O.prototype, {addPoint: function (a, b, c, d) {
        var e = this.options,
            f = this.data, g = this.graph, h = this.area, i = this.chart, j = this.xAxis && this.xAxis.names, k = g && g.shift || 0, l = e.data, m, p = this.xData;
        Pa(d, i);
        c && n([g, h, this.graphNeg, this.areaNeg], function (a) {
            if (a)a.shift = k + 1
        });
        if (h)h.isArea = !0;
        b = o(b, !0);
        d = {series: this};
        this.pointClass.prototype.applyOptions.apply(d, [a]);
        g = d.x;
        h = p.length;
        if (this.requireSorting && g < p[h - 1])for (m = !0; h && p[h - 1] > g;)h--;
        this.updateParallelArrays(d, "splice", h);
        this.updateParallelArrays(d, h);
        if (j)j[g] = d.name;
        l.splice(h, 0, a);
        m && (this.data.splice(h, 0, null),
            this.processData());
        e.legendType === "point" && this.generatePoints();
        c && (f[0] && f[0].remove ? f[0].remove(!1) : (f.shift(), this.updateParallelArrays(d, "shift"), l.shift()));
        this.isDirtyData = this.isDirty = !0;
        b && (this.getAttribs(), i.redraw())
    }, remove: function (a, b) {
        var c = this, d = c.chart, a = o(a, !0);
        if (!c.isRemoving)c.isRemoving = !0, A(c, "remove", null, function () {
            c.destroy();
            d.isDirtyLegend = d.isDirtyBox = !0;
            d.linkSeries();
            a && d.redraw(b)
        });
        c.isRemoving = !1
    }, update: function (a, b) {
        var c = this.chart, d = this.type, e = L[d].prototype,
            f, a = x(this.userOptions, {animation: !1, index: this.index, pointStart: this.xData[0]}, {data: this.options.data}, a);
        this.remove(!1);
        for (f in e)e.hasOwnProperty(f) && (this[f] = u);
        r(this, L[a.type || d].prototype);
        this.init(c, a);
        o(b, !0) && c.redraw(!1)
    }});
    r(ra.prototype, {update: function (a, b) {
        var c = this.chart, a = c.options[this.coll][this.options.index] = x(this.userOptions, a);
        this.destroy(!0);
        this._addedPlotLB = this.userMin = this.userMax = u;
        this.init(c, r(a, {events: u}));
        c.isDirtyBox = !0;
        o(b, !0) && c.redraw()
    }, remove: function (a) {
        var b =
            this.chart, c = this.coll;
        n(this.series, function (a) {
            a.remove(!1)
        });
        fa(b.axes, this);
        fa(b[c], this);
        b.options[c].splice(this.options.index, 1);
        n(b[c], function (a, b) {
            a.options.index = b
        });
        this.destroy();
        b.isDirtyBox = !0;
        o(a, !0) && b.redraw()
    }, setTitle: function (a, b) {
        this.update({title: a}, b)
    }, setCategories: function (a, b) {
        this.update({categories: a}, b)
    }});
    var aa = ga(O);
    L.line = aa;
    Y.area = x(W, {threshold: 0});
    var Ta = ga(O, {type: "area", getSegments: function () {
        var a = [], b = [], c = [], d = this.xAxis, e = this.yAxis, f = e.stacks[this.stackKey],
            g = {}, h, i, j = this.points, k = this.options.connectNulls, l, m, p;
        if (this.options.stacking && !this.cropped) {
            for (m = 0; m < j.length; m++)g[j[m].x] = j[m];
            for (p in f)f[p].total !== null && c.push(+p);
            c.sort(function (a, b) {
                return a - b
            });
            n(c, function (a) {
                if (!k || g[a] && g[a].y !== null)g[a] ? b.push(g[a]) : (h = d.translate(a), l = f[a].percent ? f[a].total ? f[a].cum * 100 / f[a].total : 0 : f[a].cum, i = e.toPixels(l, !0), b.push({y: null, plotX: h, clientX: h, plotY: i, yBottom: i, onMouseOver: ma}))
            });
            b.length && a.push(b)
        } else O.prototype.getSegments.call(this),
            a = this.segments;
        this.segments = a
    }, getSegmentPath: function (a) {
        var b = O.prototype.getSegmentPath.call(this, a), c = [].concat(b), d, e = this.options;
        d = b.length;
        var f = this.yAxis.getThreshold(e.threshold), g;
        d === 3 && c.push("L", b[1], b[2]);
        if (e.stacking && !this.closedStacks)for (d = a.length - 1; d >= 0; d--)g = o(a[d].yBottom, f), d < a.length - 1 && e.step && c.push(a[d + 1].plotX, g), c.push(a[d].plotX, g); else this.closeSegment(c, a, f);
        this.areaPath = this.areaPath.concat(c);
        return b
    }, closeSegment: function (a, b, c) {
        a.push("L", b[b.length - 1].plotX,
            c, "L", b[0].plotX, c)
    }, drawGraph: function () {
        this.areaPath = [];
        O.prototype.drawGraph.apply(this);
        var a = this, b = this.areaPath, c = this.options, d = c.negativeColor, e = c.negativeFillColor, f = [
            ["area", this.color, c.fillColor]
        ];
        (d || e) && f.push(["areaNeg", d, e]);
        n(f, function (d) {
            var e = d[0], f = a[e];
            f ? f.animate({d: b}) : a[e] = a.chart.renderer.path(b).attr({fill: o(d[2], ua(d[1]).setOpacity(o(c.fillOpacity, 0.75)).get()), zIndex: 0}).add(a.group)
        })
    }, drawLegendSymbol: R.drawRectangle});
    L.area = Ta;
    Y.spline = x(W);
    aa = ga(O, {type: "spline",
        getPointSpline: function (a, b, c) {
            var d = b.plotX, e = b.plotY, f = a[c - 1], g = a[c + 1], h, i, j, k;
            if (f && g) {
                a = f.plotY;
                j = g.plotX;
                var g = g.plotY, l;
                h = (1.5 * d + f.plotX) / 2.5;
                i = (1.5 * e + a) / 2.5;
                j = (1.5 * d + j) / 2.5;
                k = (1.5 * e + g) / 2.5;
                l = (k - i) * (j - d) / (j - h) + e - k;
                i += l;
                k += l;
                i > a && i > e ? (i = t(a, e), k = 2 * e - i) : i < a && i < e && (i = I(a, e), k = 2 * e - i);
                k > g && k > e ? (k = t(g, e), i = 2 * e - k) : k < g && k < e && (k = I(g, e), i = 2 * e - k);
                b.rightContX = j;
                b.rightContY = k
            }
            c ? (b = ["C", f.rightContX || f.plotX, f.rightContY || f.plotY, h || d, i || e, d, e], f.rightContX = f.rightContY = null) : b = ["M", d, e];
            return b
        }});
    L.spline =
        aa;
    Y.areaspline = x(Y.area);
    Ta = Ta.prototype;
    aa = ga(aa, {type: "areaspline", closedStacks: !0, getSegmentPath: Ta.getSegmentPath, closeSegment: Ta.closeSegment, drawGraph: Ta.drawGraph, drawLegendSymbol: R.drawRectangle});
    L.areaspline = aa;
    Y.column = x(W, {borderColor: "#FFFFFF", borderWidth: 1, borderRadius: 0, groupPadding: 0.2, marker: null, pointPadding: 0.1, minPointLength: 0, cropThreshold: 50, pointRange: null, states: {hover: {brightness: 0.1, shadow: !1}, select: {color: "#C0C0C0", borderColor: "#000000", shadow: !1}}, dataLabels: {align: null,
        verticalAlign: null, y: null}, stickyTracking: !1, threshold: 0});
    aa = ga(O, {type: "column", pointAttrToOptions: {stroke: "borderColor", "stroke-width": "borderWidth", fill: "color", r: "borderRadius"}, cropShoulder: 0, trackerGroups: ["group", "dataLabelsGroup"], negStacks: !0, init: function () {
        O.prototype.init.apply(this, arguments);
        var a = this, b = a.chart;
        b.hasRendered && n(b.series, function (b) {
            if (b.type === a.type)b.isDirty = !0
        })
    }, getColumnMetrics: function () {
        var a = this, b = a.options, c = a.xAxis, d = a.yAxis, e = c.reversed, f, g = {}, h, i = 0;
        b.grouping === !1 ? i = 1 : n(a.chart.series, function (b) {
            var c = b.options, e = b.yAxis;
            if (b.type === a.type && b.visible && d.len === e.len && d.pos === e.pos)c.stacking ? (f = b.stackKey, g[f] === u && (g[f] = i++), h = g[f]) : c.grouping !== !1 && (h = i++), b.columnIndex = h
        });
        var c = I(M(c.transA) * (c.ordinalSlope || b.pointRange || c.closestPointRange || 1), c.len), j = c * b.groupPadding, k = (c - 2 * j) / i, l = b.pointWidth, b = s(l) ? (k - l) / 2 : k * b.pointPadding, l = o(l, k - 2 * b);
        return a.columnMetrics = {width: l, offset: b + (j + ((e ? i - (a.columnIndex || 0) : a.columnIndex) || 0) * k - c / 2) * (e ? -1 : 1)}
    }, translate: function () {
        var a =
            this.chart, b = this.options, c = b.borderWidth, d = this.yAxis, e = this.translatedThreshold = d.getThreshold(b.threshold), f = o(b.minPointLength, 5), b = this.getColumnMetrics(), g = b.width, h = this.barW = Ia(t(g, 1 + 2 * c)), i = this.pointXOffset = b.offset, j = -(c % 2 ? 0.5 : 0), k = c % 2 ? 0.5 : 1;
        a.renderer.isVML && a.inverted && (k += 1);
        O.prototype.translate.apply(this);
        n(this.points, function (a) {
            var b = o(a.yBottom, e), c = I(t(-999 - b, a.plotY), d.len + 999 + b), n = a.plotX + i, s = h, r = I(c, b), u, c = t(c, b) - r;
            M(c) < f && f && (c = f, r = w(M(r - e) > f ? b - f : e - (d.translate(a.y, 0, 1, 0,
                1) <= e ? f : 0)));
            a.barX = n;
            a.pointWidth = g;
            b = M(n) < 0.5;
            s = w(n + s) + j;
            n = w(n) + j;
            s -= n;
            u = M(r) < 0.5;
            c = w(r + c) + k;
            r = w(r) + k;
            c -= r;
            b && (n += 1, s -= 1);
            u && (r -= 1, c += 1);
            a.shapeType = "rect";
            a.shapeArgs = {x: n, y: r, width: s, height: c}
        })
    }, getSymbol: ma, drawLegendSymbol: R.drawRectangle, drawGraph: ma, drawPoints: function () {
        var a = this, b = this.chart, c = a.options, d = b.renderer, e = b.options.animationLimit || 250, f;
        n(a.points, function (g) {
            var h = g.plotY, i = g.graphic;
            if (h !== u && !isNaN(h) && g.y !== null)f = g.shapeArgs, i ? (Ya(i), i[b.pointCount < e ? "animate" : "attr"](x(f))) :
                g.graphic = d[g.shapeType](f).attr(g.pointAttr[g.selected ? "select" : ""]).add(a.group).shadow(c.shadow, null, c.stacking && !c.borderRadius); else if (i)g.graphic = i.destroy()
        })
    }, drawTracker: J.drawTrackerPoint, animate: function (a) {
        var b = this.yAxis, c = this.options, d = this.chart.inverted, e = {};
        if (V)a ? (e.scaleY = 0.001, a = I(b.pos + b.len, t(b.pos, b.toPixels(c.threshold))), d ? e.translateX = a - b.len : e.translateY = a, this.group.attr(e)) : (e.scaleY = 1, e[d ? "translateX" : "translateY"] = b.pos, this.group.animate(e, this.options.animation),
            this.animate = null)
    }, remove: function () {
        var a = this, b = a.chart;
        b.hasRendered && n(b.series, function (b) {
            if (b.type === a.type)b.isDirty = !0
        });
        O.prototype.remove.apply(a, arguments)
    }});
    L.column = aa;
    Y.bar = x(Y.column);
    aa = ga(aa, {type: "bar", inverted: !0});
    L.bar = aa;
    Y.scatter = x(W, {lineWidth: 0, tooltip: {headerFormat: '<span style="font-size: 10px; color:{series.color}">{series.name}</span><br/>', pointFormat: "x: <b>{point.x}</b><br/>y: <b>{point.y}</b><br/>", followPointer: !0}, stickyTracking: !1});
    aa = ga(O, {type: "scatter", sorted: !1,
        requireSorting: !1, noSharedTooltip: !0, trackerGroups: ["markerGroup"], takeOrdinalPosition: !1, drawTracker: J.drawTrackerPoint, drawGraph: function () {
            this.options.lineWidth && O.prototype.drawGraph.call(this)
        }, setTooltipPoints: ma});
    L.scatter = aa;
    Y.pie = x(W, {borderColor: "#FFFFFF", borderWidth: 1, center: [null, null], clip: !1, colorByPoint: !0, dataLabels: {distance: 30, enabled: !0, formatter: function () {
        return this.point.name
    }}, ignoreHiddenPoint: !0, legendType: "point", marker: null, size: null, showInLegend: !1, slicedOffset: 10, states: {hover: {brightness: 0.1,
        shadow: !1}}, stickyTracking: !1, tooltip: {followPointer: !0}});
    W = {type: "pie", isCartesian: !1, pointClass: ga(Ka, {init: function () {
        Ka.prototype.init.apply(this, arguments);
        var a = this, b;
        if (a.y < 0)a.y = null;
        r(a, {visible: a.visible !== !1, name: o(a.name, "Slice")});
        b = function (b) {
            a.slice(b.type === "select")
        };
        F(a, "select", b);
        F(a, "unselect", b);
        return a
    }, setVisible: function (a) {
        var b = this, c = b.series, d = c.chart, e;
        b.visible = b.options.visible = a = a === u ? !b.visible : a;
        c.options.data[ta(b, c.data)] = b.options;
        e = a ? "show" : "hide";
        n(["graphic",
            "dataLabel", "connector", "shadowGroup"], function (a) {
            if (b[a])b[a][e]()
        });
        b.legendItem && d.legend.colorizeItem(b, a);
        if (!c.isDirty && c.options.ignoreHiddenPoint)c.isDirty = !0, d.redraw()
    }, slice: function (a, b, c) {
        var d = this.series;
        Pa(c, d.chart);
        o(b, !0);
        this.sliced = this.options.sliced = a = s(a) ? a : !this.sliced;
        d.options.data[ta(this, d.data)] = this.options;
        a = a ? this.slicedTranslation : {translateX: 0, translateY: 0};
        this.graphic.animate(a);
        this.shadowGroup && this.shadowGroup.animate(a)
    }}), requireSorting: !1, noSharedTooltip: !0,
        trackerGroups: ["group", "dataLabelsGroup"], axisTypes: [], pointAttrToOptions: {stroke: "borderColor", "stroke-width": "borderWidth", fill: "color"}, getColor: ma, animate: function (a) {
            var b = this, c = b.points, d = b.startAngleRad;
            if (!a)n(c, function (a) {
                var c = a.graphic, a = a.shapeArgs;
                c && (c.attr({r: b.center[3] / 2, start: d, end: d}), c.animate({r: a.r, start: a.start, end: a.end}, b.options.animation))
            }), b.animate = null
        }, setData: function (a, b) {
            O.prototype.setData.call(this, a, !1);
            this.processData();
            this.generatePoints();
            o(b, !0) && this.chart.redraw()
        },
        generatePoints: function () {
            var a, b = 0, c, d, e, f = this.options.ignoreHiddenPoint;
            O.prototype.generatePoints.call(this);
            c = this.points;
            d = c.length;
            for (a = 0; a < d; a++)e = c[a], b += f && !e.visible ? 0 : e.y;
            this.total = b;
            for (a = 0; a < d; a++)e = c[a], e.percentage = b > 0 ? e.y / b * 100 : 0, e.total = b
        }, translate: function (a) {
            this.generatePoints();
            var b = 0, c = this.options, d = c.slicedOffset, e = d + c.borderWidth, f, g, h, i = c.startAngle || 0, j = this.startAngleRad = Ba / 180 * (i - 90), i = (this.endAngleRad = Ba / 180 * ((c.endAngle || i + 360) - 90)) - j, k = this.points, l = c.dataLabels.distance,
                c = c.ignoreHiddenPoint, m, n = k.length, o;
            if (!a)this.center = a = this.getCenter();
            this.getX = function (b, c) {
                h = P.asin((b - a[1]) / (a[2] / 2 + l));
                return a[0] + (c ? -1 : 1) * U(h) * (a[2] / 2 + l)
            };
            for (m = 0; m < n; m++) {
                o = k[m];
                f = j + b * i;
                if (!c || o.visible)b += o.percentage / 100;
                g = j + b * i;
                o.shapeType = "arc";
                o.shapeArgs = {x: a[0], y: a[1], r: a[2] / 2, innerR: a[3] / 2, start: w(f * 1E3) / 1E3, end: w(g * 1E3) / 1E3};
                h = (g + f) / 2;
                h > 0.75 * i && (h -= 2 * Ba);
                o.slicedTranslation = {translateX: w(U(h) * d), translateY: w($(h) * d)};
                f = U(h) * a[2] / 2;
                g = $(h) * a[2] / 2;
                o.tooltipPos = [a[0] + f * 0.7, a[1] + g *
                    0.7];
                o.half = h < -Ba / 2 || h > Ba / 2 ? 1 : 0;
                o.angle = h;
                e = I(e, l / 2);
                o.labelPos = [a[0] + f + U(h) * l, a[1] + g + $(h) * l, a[0] + f + U(h) * e, a[1] + g + $(h) * e, a[0] + f, a[1] + g, l < 0 ? "center" : o.half ? "right" : "left", h]
            }
        }, setTooltipPoints: ma, drawGraph: null, drawPoints: function () {
            var a = this, b = a.chart.renderer, c, d, e = a.options.shadow, f, g;
            if (e && !a.shadowGroup)a.shadowGroup = b.g("shadow").add(a.group);
            n(a.points, function (h) {
                d = h.graphic;
                g = h.shapeArgs;
                f = h.shadowGroup;
                if (e && !f)f = h.shadowGroup = b.g("shadow").add(a.shadowGroup);
                c = h.sliced ? h.slicedTranslation :
                {translateX: 0, translateY: 0};
                f && f.attr(c);
                d ? d.animate(r(g, c)) : h.graphic = d = b.arc(g).setRadialReference(a.center).attr(h.pointAttr[h.selected ? "select" : ""]).attr({"stroke-linejoin": "round"}).attr(c).add(a.group).shadow(e, f);
                h.visible !== void 0 && h.setVisible(h.visible)
            })
        }, sortByAngle: function (a, b) {
            a.sort(function (a, d) {
                return a.angle !== void 0 && (d.angle - a.angle) * b
            })
        }, drawTracker: J.drawTrackerPoint, drawLegendSymbol: R.drawRectangle, getCenter: xb.getCenter, getSymbol: ma};
    W = ga(O, W);
    L.pie = W;
    O.prototype.drawDataLabels =
        function () {
            var a = this, b = a.options, c = b.cursor, d = b.dataLabels, b = a.points, e, f, g, h;
            if (d.enabled || a._hasPointLabels)a.dlProcessOptions && a.dlProcessOptions(d), h = a.plotGroup("dataLabelsGroup", "data-labels", a.visible ? "visible" : "hidden", d.zIndex || 6), f = d, n(b, function (b) {
                var j, k = b.dataLabel, l, m, n = b.connector, q = !0;
                e = b.options && b.options.dataLabels;
                j = o(e && e.enabled, f.enabled);
                if (k && !j)b.dataLabel = k.destroy(); else if (j) {
                    d = x(f, e);
                    j = d.rotation;
                    l = b.getLabelConfig();
                    g = d.format ? Ga(d.format, l) : d.formatter.call(l, d);
                    d.style.color = o(d.color, d.style.color, a.color, "black");
                    if (k)if (s(g))k.attr({text: g}), q = !1; else {
                        if (b.dataLabel = k = k.destroy(), n)b.connector = n.destroy()
                    } else if (s(g)) {
                        k = {fill: d.backgroundColor, stroke: d.borderColor, "stroke-width": d.borderWidth, r: d.borderRadius || 0, rotation: j, padding: d.padding, zIndex: 1};
                        for (m in k)k[m] === u && delete k[m];
                        k = b.dataLabel = a.chart.renderer[j ? "text" : "label"](g, 0, -999, null, null, null, d.useHTML).attr(k).css(r(d.style, c && {cursor: c})).add(h).shadow(d.shadow)
                    }
                    k && a.alignDataLabel(b, k,
                        d, null, q)
                }
            })
        };
    O.prototype.alignDataLabel = function (a, b, c, d, e) {
        var f = this.chart, g = f.inverted, h = o(a.plotX, -999), i = o(a.plotY, -999), j = b.getBBox();
        if (a = this.visible && (a.series.forceDL || f.isInsidePlot(a.plotX, a.plotY, g)))d = r({x: g ? f.plotWidth - i : h, y: w(g ? f.plotHeight - h : i), width: 0, height: 0}, d), r(c, {width: j.width, height: j.height}), c.rotation ? (g = {align: c.align, x: d.x + c.x + d.width / 2, y: d.y + c.y + d.height / 2}, b[e ? "attr" : "animate"](g)) : (b.align(c, null, d), g = b.alignAttr, o(c.overflow, "justify") === "justify" ? this.justifyDataLabel(b,
            c, g, j, d, e) : o(c.crop, !0) && (a = f.isInsidePlot(g.x, g.y) && f.isInsidePlot(g.x + j.width, g.y + j.height)));
        if (!a)b.attr({y: -999}), b.placed = !1
    };
    O.prototype.justifyDataLabel = function (a, b, c, d, e, f) {
        var g = this.chart, h = b.align, i = b.verticalAlign, j, k;
        j = c.x;
        if (j < 0)h === "right" ? b.align = "left" : b.x = -j, k = !0;
        j = c.x + d.width;
        if (j > g.plotWidth)h === "left" ? b.align = "right" : b.x = g.plotWidth - j, k = !0;
        j = c.y;
        if (j < 0)i === "bottom" ? b.verticalAlign = "top" : b.y = -j, k = !0;
        j = c.y + d.height;
        if (j > g.plotHeight)i === "top" ? b.verticalAlign = "bottom" : b.y = g.plotHeight -
            j, k = !0;
        if (k)a.placed = !f, a.align(b, null, e)
    };
    if (L.pie)L.pie.prototype.drawDataLabels = function () {
        var a = this, b = a.data, c, d = a.chart, e = a.options.dataLabels, f = o(e.connectorPadding, 10), g = o(e.connectorWidth, 1), h = d.plotWidth, d = d.plotHeight, i, j, k = o(e.softConnector, !0), l = e.distance, m = a.center, p = m[2] / 2, q = m[1], s = l > 0, r, u, v, x, y = [
            [],
            []
        ], z, A, E, K, B, D = [0, 0, 0, 0], I = function (a, b) {
            return b.y - a.y
        };
        if (a.visible && (e.enabled || a._hasPointLabels)) {
            O.prototype.drawDataLabels.apply(a);
            n(b, function (a) {
                a.dataLabel && a.visible && y[a.half].push(a)
            });
            for (K = 0; !x && b[K];)x = b[K] && b[K].dataLabel && (b[K].dataLabel.getBBox().height || 21), K++;
            for (K = 2; K--;) {
                var b = [], J = [], F = y[K], G = F.length, C;
                a.sortByAngle(F, K - 0.5);
                if (l > 0) {
                    for (B = q - p - l; B <= q + p + l; B += x)b.push(B);
                    u = b.length;
                    if (G > u) {
                        c = [].concat(F);
                        c.sort(I);
                        for (B = G; B--;)c[B].rank = B;
                        for (B = G; B--;)F[B].rank >= u && F.splice(B, 1);
                        G = F.length
                    }
                    for (B = 0; B < G; B++) {
                        c = F[B];
                        v = c.labelPos;
                        c = 9999;
                        var L, N;
                        for (N = 0; N < u; N++)L = M(b[N] - v[1]), L < c && (c = L, C = N);
                        if (C < B && b[B] !== null)C = B; else for (u < G - B + C && b[B] !== null && (C = u - G + B); b[C] === null;)C++;
                        J.push({i: C,
                            y: b[C]});
                        b[C] = null
                    }
                    J.sort(I)
                }
                for (B = 0; B < G; B++) {
                    c = F[B];
                    v = c.labelPos;
                    r = c.dataLabel;
                    E = c.visible === !1 ? "hidden" : "visible";
                    c = v[1];
                    if (l > 0) {
                        if (u = J.pop(), C = u.i, A = u.y, c > A && b[C + 1] !== null || c < A && b[C - 1] !== null)A = c
                    } else A = c;
                    z = e.justify ? m[0] + (K ? -1 : 1) * (p + l) : a.getX(C === 0 || C === b.length - 1 ? c : A, K);
                    r._attr = {visibility: E, align: v[6]};
                    r._pos = {x: z + e.x + ({left: f, right: -f}[v[6]] || 0), y: A + e.y - 10};
                    r.connX = z;
                    r.connY = A;
                    if (this.options.size === null)u = r.width, z - u < f ? D[3] = t(w(u - z + f), D[3]) : z + u > h - f && (D[1] = t(w(z + u - h + f), D[1])), A - x / 2 < 0 ? D[0] =
                        t(w(-A + x / 2), D[0]) : A + x / 2 > d && (D[2] = t(w(A + x / 2 - d), D[2]))
                }
            }
            if (Aa(D) === 0 || this.verifyDataLabelOverflow(D))this.placeDataLabels(), s && g && n(this.points, function (b) {
                i = b.connector;
                v = b.labelPos;
                if ((r = b.dataLabel) && r._pos)E = r._attr.visibility, z = r.connX, A = r.connY, j = k ? ["M", z + (v[6] === "left" ? 5 : -5), A, "C", z, A, 2 * v[2] - v[4], 2 * v[3] - v[5], v[2], v[3], "L", v[4], v[5]] : ["M", z + (v[6] === "left" ? 5 : -5), A, "L", v[2], v[3], "L", v[4], v[5]], i ? (i.animate({d: j}), i.attr("visibility", E)) : b.connector = i = a.chart.renderer.path(j).attr({"stroke-width": g,
                    stroke: e.connectorColor || b.color || "#606060", visibility: E}).add(a.group); else if (i)b.connector = i.destroy()
            })
        }
    }, L.pie.prototype.placeDataLabels = function () {
        n(this.points, function (a) {
            var a = a.dataLabel, b;
            if (a)(b = a._pos) ? (a.attr(a._attr), a[a.moved ? "animate" : "attr"](b), a.moved = !0) : a && a.attr({y: -999})
        })
    }, L.pie.prototype.alignDataLabel = ma, L.pie.prototype.verifyDataLabelOverflow = function (a) {
        var b = this.center, c = this.options, d = c.center, e = c = c.minSize || 80, f;
        d[0] !== null ? e = t(b[2] - t(a[1], a[3]), c) : (e = t(b[2] - a[1] - a[3],
            c), b[0] += (a[3] - a[1]) / 2);
        d[1] !== null ? e = t(I(e, b[2] - t(a[0], a[2])), c) : (e = t(I(e, b[2] - a[0] - a[2]), c), b[1] += (a[0] - a[2]) / 2);
        e < b[2] ? (b[2] = e, this.translate(b), n(this.points, function (a) {
            if (a.dataLabel)a.dataLabel._pos = null
        }), this.drawDataLabels && this.drawDataLabels()) : f = !0;
        return f
    };
    if (L.column)L.column.prototype.alignDataLabel = function (a, b, c, d, e) {
        var f = this.chart, g = f.inverted, h = a.dlBox || a.shapeArgs, i = a.below || a.plotY > o(this.translatedThreshold, f.plotSizeY), j = o(c.inside, !!this.options.stacking);
        if (h && (d = x(h),
            g && (d = {x: f.plotWidth - d.y - d.height, y: f.plotHeight - d.x - d.width, width: d.height, height: d.width}), !j))g ? (d.x += i ? 0 : d.width, d.width = 0) : (d.y += i ? d.height : 0, d.height = 0);
        c.align = o(c.align, !g || j ? "center" : i ? "right" : "left");
        c.verticalAlign = o(c.verticalAlign, g || j ? "middle" : i ? "top" : "bottom");
        O.prototype.alignDataLabel.call(this, a, b, c, d, e)
    };
    r(Highcharts, {Axis: ra, Chart: eb, Color: ua, Point: Ka, Tick: Ra, Tooltip: sb, Renderer: Xa, Series: O, SVGElement: qa, SVGRenderer: va, arrayMin: Ma, arrayMax: Aa, charts: Ja, dateFormat: $a, format: Ga,
        pathAnim: ub, getOptions: function () {
            return G
        }, hasBidiBug: Nb, isTouchDevice: Ib, numberFormat: Ea, seriesTypes: L, setOptions: function (a) {
            G = x(!0, G, a);
            Bb();
            return G
        }, addEvent: F, removeEvent: X, createElement: T, discardElement: Oa, css: D, each: n, extend: r, map: Sa, merge: x, pick: o, splat: ka, extendClass: ga, pInt: z, wrap: Ua, svg: V, canvas: ba, vml: !V && !ba, product: "Highcharts", version: "3.0.8"})
})();
