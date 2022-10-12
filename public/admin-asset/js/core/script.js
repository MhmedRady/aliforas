(function (){
    let req = document.querySelectorAll('[req]');

    req.forEach((el)=>{
        let ast = document.createElement('span');
        ast.setAttribute('class','ast');
        ast.innerText = '*';
        el.firstChild.before(ast);
    });
})();
