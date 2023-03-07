import { Component } from '@angular/core';
import { ActivatedRoute, ParamMap, Router } from '@angular/router';
import { Anime } from '../../../anime/interfaces/anime';
import { AnimeService } from 'src/app/anime/services/anime.service';
import { Respuesta } from '../../interfaces/user';
import { UserService } from '../../services/user.service';
import { catchError, EMPTY } from 'rxjs';
import { ChapterUser } from 'src/app/anime/interfaces/chapter-user';

@Component({
  selector: 'app-anime',
  templateUrl: './anime.component.html',
})
export class AnimeComponent {
  selectedAnime: Anime;
  chapterInfo: ChapterUser;
  userInfor: Respuesta;
  error: boolean = true;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private animeService: AnimeService,
    private userService: UserService
  ) {}

  ngOnInit(): void {
    this.paramMapSubscription();
  }

  paramMapSubscription(): void {
    this.route.paramMap.subscribe((params) => {
      this.userService.me().subscribe((res) => {
        this.userInfor = res;
        this.animeService
          .checkAnimeUser(this.userInfor.data.id, +params.get('id'))
          .pipe(
            catchError((err) => {
              if (err.status === 404) {
                this.router.navigate(['user/list']);
              }
              return EMPTY;
            })
          )
          .subscribe((res) => {
            if (res) {
              this.getAnimeById(params);
              this.getAnimeChaptersInfo(this.userInfor.data.id, +params.get('id'));
            }
          });
      });
    });
  }

  getAnimeById(params: ParamMap): void {
    this.animeService
      .getAnimeById(+params.get('id'))
      .subscribe((anime) => (this.selectedAnime = anime));
  }

  getAnimeChaptersInfo(user: number, anime: number): void {
    this.animeService
      .chapterByAnimeByIdUser(user, anime)
      .subscribe((chapterInfo) => (this.chapterInfo = chapterInfo));
  }

  toggleWatch(id: number, watched: boolean): void {
    watched = !watched;
    this.animeService.toggleWatch(id, watched).subscribe(
      res => console.log(res.data.watched)
    );
  }
}
