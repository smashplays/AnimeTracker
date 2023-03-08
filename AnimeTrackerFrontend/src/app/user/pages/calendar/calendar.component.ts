import { Component, OnInit } from '@angular/core';
import { CalendarOptions } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import { AnimeService } from '../../../anime/services/anime.service';
import { formatDate } from '@angular/common';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-calendar',
  templateUrl: './calendar.component.html',
})
export class CalendarComponent implements OnInit {
  constructor(
    private animeService: AnimeService,
    private userService: UserService
  ) {}

  ngOnInit(): void {
    this.userService.me().subscribe((res) => {
      this.animeService.chapterByIdUser(res.data.id).subscribe(
        (Chapters) =>
          (this.calendarOptions.events = Chapters.data.map((chapter) => {
            return {
              title: chapter.chapter.name,
              date: formatDate(chapter.chapter.aired, 'YYYY-MM-dd', 'en'),
              color: '#8509D3',
            };
          }))
      );
    });
  }
  calendarOptions: CalendarOptions = {
    initialView: 'dayGridMonth',
    plugins: [dayGridPlugin],
    events: [],
  };
}
