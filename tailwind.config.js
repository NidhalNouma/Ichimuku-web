const colors = require("tailwindcss/colors");
module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue"
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        colors: {
            transparent: "transparent",
            current: "currentColor",
            black: colors.black,
            white: colors.white,
            gray: colors.trueGray,
            indigo: colors.indigo,
            blue: colors.blue,
            green: colors.green,
            red: colors.rose,
            yellow: colors.amber,
            orange: colors.orange,

            prim: colors.gray[700],
            sec: "#b4c6d0",
            lbl: colors.gray[500],
            txt: colors.gray[900],
            axc: "#ad7f1c",
            btnTxt: colors.white
        },
        screens: {
            sm: "640px",
            // => @media (min-width: 640px) { ... }

            md: "768px",
            // => @media (min-width: 768px) { ... }

            lg: "1024px",
            // => @media (min-width: 1024px) { ... }

            xl: "1280px",
            // => @media (min-width: 1280px) { ... }

            "2xl": "1536px"
            // => @media (min-width: 1536px) { ... }
        },
        extend: {}
    },
    variants: {
        extend: {}
    },
    plugins: []
};
