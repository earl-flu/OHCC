var fulldays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            function formatDate(someDateTimeStamp) {
                let oras = someDateTimeStamp.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })

                let dt = new Date(someDateTimeStamp),
                    year = dt.getFullYear(),
                    date = dt.getDate(),
                    month = months[dt.getMonth()],
                    diffDays = new Date().getDate() - date,
                    diffMonths = new Date().getMonth() - dt.getMonth(),
                    diffYears = new Date().getFullYear() - dt.getFullYear();
 
                if(diffYears === 0 && diffDays === 0 && diffMonths === 0){
                return `Today, ${oras}`;
                }else if(diffYears === 0 && diffDays === 1) {
                return "Yesterday, "+ ' ' + oras;
                }else {
                    return `${fulldays[dt.getDay()]}, ${month}. ${date}, ${year}. ${oras}`;
                }
        }
