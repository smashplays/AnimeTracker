import { Component, OnInit } from '@angular/core';
import { Data } from '@angular/router';
import { AnimeSearch } from '../../interfaces/anime-search';
import { AnimeService } from '../../services/anime.service';

@Component({
  selector: 'app-popular-list',
  templateUrl: './popular-list.component.html',
  styleUrls: ['./popular-list.component.css'],
})
export class PopularListComponent implements OnInit {
  constructor(private animeService: AnimeService) {}

  page: number = 1;
  popularAnime: AnimeSearch;

  ngOnInit(): void {
    this.getAnimePopular();
  }

  getAnimePopular(){
    this.animeService.getAnimePopular(this.page).subscribe((animes) => {
      this.popularAnime = animes;
    });
  }

  next() {
    if (this.page < 984) {
      this.page++;
      this.getAnimePopular();
    }
  }

  back() {
    if (this.page > 1) {
      this.page--;
      this.getAnimePopular();
    }
  }
}
