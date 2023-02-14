import { Component, EventEmitter, Output } from '@angular/core';
import { debounceTime, Subject } from 'rxjs';

@Component({
  selector: 'app-anime-search',
  templateUrl: './anime-search.component.html',
  styleUrls: ['./anime-search.component.css']
})
export class AnimeSearchComponent {
  @Output() onDebounce: EventEmitter<string> = new EventEmitter();
  public searchTerm: Subject<string> = new Subject();

  input: string = '';

  constructor() {}

  ngOnInit(): void {
    this.searchTerm.pipe(
      debounceTime(300)
    ).subscribe((value) =>{
      this.onDebounce.emit(value);
    })
  }

  public search() {
    this.searchTerm.next(this.input);
  }
}
