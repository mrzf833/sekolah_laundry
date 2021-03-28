function mysqlTimeStampToDateTime(timestamp) {
    //function parses mysql datetime string and returns javascript Date object
    //input has to be in this format: 2007-06-05 15:26:02
    let regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
    let parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
    let d = new Date(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]);
    let month = d.getMonth()+1; 
    let day = d.getDate(); 
    let hour = d.getHours(); 
    let minute = d.getMinutes(); 
    let second = d.getSeconds(); 
    let output = d.getFullYear() + "-" + ((""+month).length<2 ? '0' : "") + month + "-" + ((""+day).length<2 ? "0" : "") + day + 'T' + (("" + hour).length < 2 ? '0' : '') + hour + ':' + (("" + minute).length < 2 ? '0' : '') + minute ;
    return output
}