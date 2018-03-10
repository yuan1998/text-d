import request from 'Admin/utils/request.js'


export function uploadImage(query){
    return request({
        url:'/img/upload',
        params:query,
        method:'post'
    })
}
