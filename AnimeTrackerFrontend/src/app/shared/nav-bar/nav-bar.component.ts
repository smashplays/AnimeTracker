import { Component } from '@angular/core';
import { Data } from 'src/app/anime/interfaces/anime-search';
import { AnimeService } from 'src/app/anime/services/anime.service';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html',
  styleUrls: ['./nav-bar.component.css']
})
export class NavBarComponent {
  input: string = '';
  showOverlay = true;
  suggestedAnimes: Data[];
  suggestedAnimesCopy: Data[];
  moreButton: boolean = false;

  constructor(private animeService: AnimeService) {
    
  }

  sugerencias(input: string): void {
    this.input = input;
    this.moreButton = false;

    if (!input.trim()) {
      this.suggestedAnimes = [];
      this.suggestedAnimesCopy = [];
      this.moreButton = false;
      return;
    }

    this.animeService.getAnimeSearch(input).subscribe((search) => {
      this.suggestedAnimesCopy = search;
      if (this.suggestedAnimesCopy.length > 5) {
        this.moreButton = true;
      }
      this.suggestedAnimes = this.suggestedAnimesCopy.splice(0, 5);
    });
  }

  more() {
    this.suggestedAnimes = this.suggestedAnimesCopy;
    this.suggestedAnimesCopy = [];
    this.moreButton = false;
  }

  animeSelect() {
    this.sugerencias('');
  }
}
