import { Component } from '@angular/core';
import { ActivatedRoute, ParamMap, Router } from '@angular/router';
import { Anime } from '../../../anime/interfaces/anime';
import { ChapterInfo } from '../../../anime/interfaces/chapter-info';
import { AnimeService } from 'src/app/anime/services/anime.service';
import { Respuesta } from '../../interfaces/user';
import { UserService } from '../../services/user.service';
import { catchError, EMPTY } from 'rxjs';

@Component({
  selector: 'app-anime',
  templateUrl: './anime.component.html',
})
export class AnimeComponent {
  selectedAnime: Anime;
  chapterInfo: ChapterInfo;
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
              this.getAnimeChaptersInfo(params);
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

  getAnimeChaptersInfo(params: ParamMap): void {
    this.animeService
      .getAnimeChaptersInfo(+params.get('id'))
      .subscribe((chapterInfo) => (this.chapterInfo = chapterInfo));
  }
}
