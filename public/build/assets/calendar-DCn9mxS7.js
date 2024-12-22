import{m as n,C as o,i,b as c,a as v}from"./index-BvXCc8R3.js";document.addEventListener("DOMContentLoaded",function(){n.loadPersian({usePersianDigits:!0});const r=document.getElementById("calendar");r&&new o(r,{plugins:[i,c],initialView:"dayGridMonth",editable:!0,selectable:!0,locale:"fa",events:"/admin/api/calendar-events",eventDrop:function(e){v.post("/admin/api/calendar-events/update",{id:e.event.id,start:e.event.start.toISOString(),end:e.event.end?e.event.end.toISOString():null}).then(t=>{alert("Event updated successfully.")}).catch(t=>{alert("Error updating event: "+t.response.data.message),e.revert()})},eventContent:function(e){const{title:t,extendedProps:a}=e.event,s=n(e.event.start).format("jYYYY/jMM/jDD"),d=e.event.end?n(e.event.end).format("jYYYY/jMM/jDD"):null,l=a.qr_code_url;return{html:`
                        <div>
                            <strong>${t}</strong><br/>
                            ${s}${d?" - "+d:""}
                            <br/>
                            <a href="${l}" target="_blank">View QR Code</a>
                        </div>
                    `}},datesSet:function(e){const t=n(e.start).format("jYYYY/jMM/jDD"),a=n(e.end).format("jYYYY/jMM/jDD");console.log(`Displayed Range: ${t} - ${a}`)},eventClick:function(e){const t=e.event.extendedProps.qr_code_url;t?window.open(t,"_blank"):alert("QR Code not available for this event.")}}).render()});
