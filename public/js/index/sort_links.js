export function enableSortLinks() {
  let url = new URL(window.location.href);
  let currentSort = url.searchParams.get('sort') ?? 'created_at';
  let currentOrder = url.searchParams.get('order') ?? 'desc';
  let sortLinks = Array.from(document.getElementsByClassName('sort-link'));

  sortLinks.map(function (link) {
    if (currentSort === link.id.replace('sort-', '') && currentOrder === 'asc') {
      link.href += '&order=desc';
    } else {
      link.href += '&order=asc';
    }
  });
}