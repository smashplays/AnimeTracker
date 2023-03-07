import { Component, OnInit } from '@angular/core';
import { CalendarOptions } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import { AnimeService } from '../../../anime/services/anime.service';
import { formatDate } from '@angular/common';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-calendar',
  templateUrl: './calendar.component.html'
})
export class CalendarComponent implements OnInit {
constructor(
  private animeService:AnimeService,
  private userService:UserService
){}

  ngOnInit(): void {
    
    this.animeService.chapterByIdUser(1).subscribe(res => 
      {
       res.data.map(res => console.log(formatDate(res.chapter.aired,'YYYY-MM-dd','en')))
      })

      this.userService.me().subscribe(res =>{
        this.animeService.chapterByIdUser(res.data.id).subscribe(Chapters=>
      this.calendarOptions.events= Chapters.data.map(chapter=>{
        return {
          title:chapter.chapter.name,
          date:formatDate(chapter.chapter.aired,'YYYY-MM-dd','en'),
          color:'red'
        }
      })
        )
      })

    
  }
  calendarOptions: CalendarOptions = {
    initialView: 'dayGridMonth',
    plugins: [dayGridPlugin],
    events: [
      { title: 'A', date: '2023-02-22', color: 'red' },
      { title: 'B', date: '2023-02-23', color: 'blue' },
      { title: 'C', date: '2023-02-24', color: 'green' },
    ],
  };
}
