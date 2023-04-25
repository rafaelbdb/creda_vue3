const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
    transpileDependencies: true,
    devServer: {
        historyApiFallback: true,
        proxy: 'http://localhost:8080'
    }
})
