const express = require('express');
const app = express();
const server = app.listen(3000,()=>{})
const io = require('socket.io')(server,{
    cors:{


        origin:"",
        methods:["GET","POST"],
        Credentials:true
    }
});
app.use(express.static(__dirname+'/public'));
io.on("connection",client=>{
    console.log("Nawiązano połączenie");
})