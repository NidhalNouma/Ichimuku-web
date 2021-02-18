(() => {
    var e = {
            99: () => {
                window.scrollY;
                var e = document.getElementById("header"),
                    t = document.getElementById("nav-content"),
                    s = document.getElementById("navAction"),
                    n =
                        (document.getElementById("brandname"),
                        document.querySelectorAll(".toggleColour"));
                document.addEventListener("scroll", function() {
                    if (window.scrollY > 10) {
                        e.classList.add("bg-white"),
                            s.classList.remove("bg-white"),
                            s.classList.add("gradient"),
                            s.classList.remove("text-gray-800"),
                            s.classList.add("text-white");
                        for (var a = 0; a < n.length; a++)
                            n[a].classList.add("text-gray-800"),
                                n[a].classList.remove("text-white");
                        e.classList.add("shadow"),
                            t.classList.remove("bg-gray-100"),
                            t.classList.add("bg-white");
                    } else {
                        e.classList.remove("bg-white"),
                            s.classList.remove("gradient"),
                            s.classList.add("bg-white"),
                            s.classList.remove("text-white"),
                            s.classList.add("text-gray-800");
                        for (a = 0; a < n.length; a++)
                            n[a].classList.add("text-white"),
                                n[a].classList.remove("text-gray-800");
                        e.classList.remove("shadow"),
                            t.classList.remove("bg-white"),
                            t.classList.add("bg-gray-100");
                    }
                });
                var a = document.getElementById("nav-content"),
                    r = document.getElementById("nav-toggle");
                function o(e, t) {
                    for (; e.parentNode; ) {
                        if (e == t) return !0;
                        e = e.parentNode;
                    }
                    return !1;
                }
                document.onclick = function(e) {
                    var t = (e && e.target) || (event && event.srcElement);
                    o(t, a) ||
                        (o(t, r) && a.classList.contains("hidden")
                            ? a.classList.remove("hidden")
                            : a.classList.add("hidden"));
                };
            },
            916: () => {}
        },
        t = {};
    function s(n) {
        if (t[n]) return t[n].exports;
        var a = (t[n] = { exports: {} });
        return e[n](a, a.exports, s), a.exports;
    }
    (s.m = e),
        (s.x = e => {}),
        (s.o = (e, t) => Object.prototype.hasOwnProperty.call(e, t)),
        (() => {
            var e = { 773: 0 },
                t = [[99], [916]],
                n = e => {},
                a = (a, r) => {
                    for (
                        var o, l, [d, i, c, g] = r, h = 0, m = [];
                        h < d.length;
                        h++
                    )
                        (l = d[h]),
                            s.o(e, l) && e[l] && m.push(e[l][0]),
                            (e[l] = 0);
                    for (o in i) s.o(i, o) && (s.m[o] = i[o]);
                    for (c && c(s), a && a(r); m.length; ) m.shift()();
                    return g && t.push.apply(t, g), n();
                },
                r = (self.webpackChunk = self.webpackChunk || []);
            function o() {
                for (var n, a = 0; a < t.length; a++) {
                    for (var r = t[a], o = !0, l = 1; l < r.length; l++) {
                        var d = r[l];
                        0 !== e[d] && (o = !1);
                    }
                    o && (t.splice(a--, 1), (n = s((s.s = r[0]))));
                }
                return 0 === t.length && (s.x(), (s.x = e => {})), n;
            }
            r.forEach(a.bind(null, 0)), (r.push = a.bind(null, r.push.bind(r)));
            var l = s.x;
            s.x = () => ((s.x = l || (e => {})), (n = o)());
        })(),
        s.x();
})();
