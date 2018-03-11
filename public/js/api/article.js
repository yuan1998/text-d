



// service.interceptors.request.use(config => {
//   // Do something before request is sent
//   if (store.getters.token) {
//     config.headers['X-Token'] = getToken() // 让每个请求携带token-- ['X-Token']为自定义key 请根据实际情况自行修改
//   }
//   return config
// }, error => {
//   // Do something with request error
//   console.log(error) // for debug
//   Promise.reject(error)
// })







function createArticle(query){
    return service({
        url: '/article/add',
        params:query,
        method:'post'
    })
}

function articleList (query){
    return service({
        url: '/article/list',
        params:query,
        method:'post'
    })
}

async function fetchArticle (query){
    return service({
        url: '/article/fetch',
        params : query,
        method: 'post'
    })
}

function articleEdit(query){
    return service({
        url: '/article/change',
        params:query,
        method:'post'
    })
}

