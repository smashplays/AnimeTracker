import { Component } from '@angular/core';
import { Data } from './anime/interfaces/anime-search';
import { AnimeService } from './anime/services/anime.service';
import {
  Router,
  Event as RouterEvent,
  NavigationStart,
  NavigationEnd,
  NavigationCancel,
  NavigationError
} from '@angular/router'

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  title = 'AnimeTrackerFrontend';

  input: string = '';
  showOverlay = true;
  suggestedAnimes: Data[];
  suggestedAnimesCopy: Data[];
  moreButton: boolean = false;

  constructor(private animeService: AnimeService, private router: Router) {
    
  }

  ngOnInit(): void {
    this.router.events.subscribe((event: RouterEvent) => {
      this.navigationInterceptor(event)
    })
  }

  navigationInterceptor(event: RouterEvent): void {
    if (event instanceof NavigationStart) {
      this.showOverlay = true;
    }
    if (event instanceof NavigationEnd) {
      this.showOverlay = false;
    }

    // Set loading state to false in both of the below events to hide the spinner in case a request fails
    if (event instanceof NavigationCancel) {
      this.showOverlay = false;
    }
    if (event instanceof NavigationError) {
      this.showOverlay = false;
    }
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
