import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap, Router } from '@angular/router';
import { Anime } from '../../interfaces/anime';
import { AnimeService } from '../../services/anime.service';
import { Characters } from '../../interfaces/characters';
import { DomSanitizer } from '@angular/platform-browser';
import { AnimeAdd } from '../../interfaces/anime-add';
import { Respuesta } from 'src/app/user/interfaces/user';
import { UserService } from '../../../user/services/user.service';
import { Episode } from '../../interfaces/episodes';
import { Chapters, ChaptersI, ChaptersA } from '../../interfaces/chapters';
import { ChapterInfo } from '../../interfaces/chapter-info';
import { catchError, EMPTY, map } from 'rxjs';

@Component({
  selector: 'app-info',
  templateUrl: './info.component.html',
})
export class InfoComponent implements OnInit {
  selectedAnime: Anime;
  animeAdd: AnimeAdd;
  animeCharacters: Characters;
  episodes: Episode;
  chaptersAnime: Chapters;
  chapterInfo: ChapterInfo;

  characters: boolean = true;
  trailer: boolean = false;
  chapters: boolean = false;
  animeAdded: boolean = false;
  addButton: string = '➕';
  userInfor: Respuesta;
  charge: boolean = false;
  capitulos:ChaptersI[];
  capitulosA:ChaptersA[];

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private animeService: AnimeService,
    private userService: UserService,
    private sanitizer: DomSanitizer
  ) {}

  ngOnInit(): void {
    this.paramMapSubscription();
    this.userService.me().subscribe((res) => {
      this.userInfor = res;
      this.animeService.checkAnimeUser(this.userInfor.data.id, this.selectedAnime.data.mal_id).subscribe((res) => {
        this.addButton = '➕';
        this.animeAdded = false;
        if (res) {
          this.addButton = '✔';
          this.animeAdded = true;
        }
      });
      this.charge = true;
    });
  }

  paramMapSubscription(): void {
    this.route.paramMap.subscribe((params) => {
      this.getAnimeById(params);
      this.getAnimeEpisodes(params);
      this.getAnimeCharacters(params);
    });
  }

  getAnimeById(params: ParamMap): void {
    this.animeService
      .getAnimeById(+params.get('id'))
      .pipe(
        catchError((err) => {
          if (err.status === 404) {
            this.router.navigate(['anime/popular']);
          }
          return EMPTY;
        })
      )
      .subscribe((anime) => (this.selectedAnime = anime));
  }

  getAnimeChaptersInfo(id: number) {
    
    this.animeService.getAnimeChaptersInfo(id).subscribe((chapterInfo) => {
      this.chapterInfo = chapterInfo;
      
      
      if (this.chapterInfo) {
        this.userService.me().subscribe(res =>{
          this.capitulos=  this.chapterInfo.data.map(chapter =>{
            return {
                user_id:res.data.id,
                anime_chapter_id:chapter.id,
                watched:false
            }
        })
        this.animeService.addChapterUser(this.capitulos).subscribe()
        })
       
        console.log(this.capitulos)
        // this.chapterInfo.data.forEach((element) => {
        //   console.log('hola')
        //   this.animeService
        //     .addChapterUser(this.userInfor.data.id, element.id)
        //   //   .subscribe((res) => console.log('agregado'));
        // });
      }
    });
  }

  getAnimeEpisodes(params: ParamMap): void {
    this.animeService
      .getAnimeEpisodes(+params.get('id'))
      .subscribe((episodes) => (this.episodes = episodes));
  }

  getAnimeCharacters(params: ParamMap): void {
    this.animeService
      .getAnimeCharacters(+params.get('id'))
      .subscribe((characters) => (this.animeCharacters = characters));
  }

  characterBool() {
    this.characters = true;
    this.trailer = false;
    this.chapters = false;
  }

  trailerBool() {
    this.trailer = true;
    this.characters = false;
    this.chapters = false;
  }

  chaptersBool() {
    this.chapters = true;
    this.characters = false;
    this.trailer = false;
  }

  addedFalse() {
    this.addButton = '➕';
    this.animeAdded = false;
    this.characters = true;
    this.animeService
      .deleteAnimeByUser(this.selectedAnime.data.mal_id, this.userInfor.data.id)
      .subscribe();
  }

  addedTrue() {
    this.addButton = '✔';
    if (!this.animeService.checkAnime(this.selectedAnime.data.mal_id)) {
      this.animeService
        .addAnime({
          name: this.selectedAnime.data.title,
          mal_id: this.selectedAnime.data.mal_id,
          image: this.selectedAnime.data.images.jpg.image_url,
        })
        .subscribe((animeAdd) => {
          this.animeAdd = animeAdd;
          this.animeService.getAnimeEpisodes(this.selectedAnime.data.mal_id).subscribe(
            res=>{

              console.log(res)
            this.capitulosA= res.data.map(rs => {
              return {
              name:rs.title,
              aired:rs.aired,
              anime_id: this.selectedAnime.data.mal_id  
              }
            })
            this.animeService.addAnimeEpisodes(this.capitulosA).subscribe(res => 
              this.getAnimeChaptersInfo(this.selectedAnime.data.mal_id)
              
            )
          })
          
          
          // .forEach((element, index) => {
          //   this.animeService
          //     .addAnimeEpisodes(
          //       this.selectedAnime.data.title +
          //         ' Episode ' +
          //         (index + 1) +
          //         ' ' +
          //         this.episodes.data[index].title,
          //       this.episodes.data[index].aired,
          //       this.selectedAnime.data.mal_id
          //     )
          //     .subscribe((chapters) => {
          //       this.chaptersAnime = chapters;
          //       if(this.episodes.data.length === index + 1){
          //         this.getAnimeChaptersInfo(this.selectedAnime.data.mal_id);
          //       }
          //     });
          // });
        });
    }

    else{
      this.animeService.getAnimeEpisodes(this.selectedAnime.data.mal_id).subscribe(
        res=>{

          console.log(res)
        this.capitulosA= res.data.map(rs => {
          return {
          name:rs.title,
          aired:rs.aired,
          anime_id: this.selectedAnime.data.mal_id  
          }
        })
        this.animeService.addAnimeEpisodes(this.capitulosA).subscribe(res => 
          this.getAnimeChaptersInfo(this.selectedAnime.data.mal_id)
          
        )
      })
      
    }

    this.animeService
      .addAnimeUser(this.userInfor.data.id, this.selectedAnime.data.mal_id)
      .subscribe((res) => {});

    this.animeAdded = true;
  }

  sanitizedUrl(url: string) {
    return this.sanitizer.bypassSecurityTrustResourceUrl(url);
  }

  addAnime(): void {
    if (this.animeAdded) {
      this.addedFalse();
    } else {
      this.addedTrue();
    }
  }
  
}
