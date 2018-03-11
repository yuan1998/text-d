

function getCatTree(query){
    return service({
        url: '/project/getTree',
        params:query,
        method:'post'
    })
}


function createProjectCat(query){
    return service({
        url: '/project/addCat',
        params:query,
        method:'post'
    })
}
