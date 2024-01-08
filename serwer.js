const express = require('express');
const app = express();
const server = app.listen(3000, ()=>{})
const io = require('socket.io')(server, {
        cors: {
            origin: "*",
            methods: ["GET","POST"],
            Credentials: true
        }
});
app.use(express.static(__dirname+'/public'));
let userlist = [];
io.on("connection", client=>{
    console.log("Nawiązano połączenie");
    client.emit('username');
    client.on('sendname',(clientid,username)=>{
        userlist.filter(e=>e.clientid==clientid)[0];
        if(!user){
            user ={clientid:clientid,username:username,socket:client,tn:new Date()}
            userlist.push(user);
        }
        console.log(user,clientid,username,client.id);
    })
    
})

