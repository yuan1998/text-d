import request from 'Admin/utils/request.js'

export function createArticle(query){
    return request({
        url: '/article/add',
        params:query,
        method:'post'
    })
}

export function articleList (query){
    return request({
        url: '/article/list',
        params:query,
        method:'post'
    })
}

export async function fetchArticle (query){
    return request({
        url: '/article/fetch',
        params : query,
        method: 'post'
    })
}

export function articleChange(query){
    return request({
        url: '.article/change',
        params:query,
        method:'post'
    })
}

