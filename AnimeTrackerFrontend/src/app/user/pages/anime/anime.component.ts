import { Component } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Anime } from '../../../anime/interfaces/anime';
import { ChapterInfo } from '../../../anime/interfaces/chapter-info';
import { AnimeService } from 'src/app/anime/services/anime.service';
import { Respuesta } from '../../interfaces/user';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-anime',
  templateUrl: './anime.component.html'
})
export class AnimeComponent {
  selectedAnime: Anime;
  chapterInfo: ChapterInfo;
  userInfor: Respuesta;

  constructor(
    private route: ActivatedRoute,
    private animeService: AnimeService,
    private userService: UserService,
  ) {}

  ngOnInit(): void {
    this.paramMapSubscription();
    this.userService.me().subscribe((res) => {
      this.userInfor = res;
    });
  }

  paramMapSubscription(): void {
    this.route.paramMap.subscribe((params) => {
      this.getAnimeById(params);
      this.getAnimeChaptersInfo(params);
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
