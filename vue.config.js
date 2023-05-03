// RELOAD VUE APP WHEN CHANGES ARE MADE HERE

const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
    transpileDependencies: true,
    devServer: {
        historyApiFallback: true
    }
})
