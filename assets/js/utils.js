async function getMovies(url, target) {
    const res = await fetch(url)
    const data = await res.json()
    let movies = data.results

    movies.forEach((movie) => {
        const image = `
                    <div class='relative h-[240px] overflow-hidden'>
                        <div class="absolute w-full h-full bg-gradient-to-t from-[#1A171E] to-[#1A171E]/0 z-10 rounded-[18px]"></div>
                        <img src='https://image.tmdb.org/t/p/original/${movie.backdrop_path}' class='w-full h-[240px] rounded-[20px] object-contain object-cover'/>
                        <p class='relative bottom-12 left-8 text-white z-10'>${movie.name}</p>
                    </div>`
        target.innerHTML += image
    })
}


export {getMovies}